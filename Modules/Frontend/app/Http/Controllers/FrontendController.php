<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Number;
use Modules\Admin\Models\Blog;
use Modules\Admin\Models\BlogCms;
use Modules\Admin\Models\PageHomeCms;
use Modules\Admin\Models\ProgramCms;
use Modules\Admin\Models\Donasi;
use Modules\Admin\Models\Donatur;
use Modules\Admin\Models\Payment;
use Modules\Admin\Models\Program;
use Modules\Admin\Models\TentangKamiCms;
use Modules\Admin\Models\Wakaf;

class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::where('ended_at', '>=', Carbon::now())
            ->where('featured', '1')
            ->limit(4)
            ->get();
        $herosections = PageHomeCms::all();
        $programCMS = ProgramCms::first();
        $tentangkami = TentangKamiCms::first();
        $blogs = Blog::with('category')->limit(6)->get();
        $blogcms = BlogCms::first();
        $totalDonatur = Donatur::count();
        $totalTerkumpul = Number::currency(Payment::sum('amount'), in: 'IDR', locale: 'id');
        $targetAmount = Number::currency(6000000000, in: 'IDR', locale: 'id');
        $totalProgram = Program::count();
        return view('frontend::pages.index', compact('totalProgram', 'targetAmount', 'totalDonatur', 'totalTerkumpul', 'programs', 'herosections', 'programCMS', 'tentangkami', 'blogs', 'blogcms'));
    }

    public function handle_payment()
    {

        $order_id = request()->get('order_id');
        $status = request()->get('transaction_status');
        $payment = Payment::where('transaction_id', $order_id)->first();
        $model = request()->get('wakaf_id') ? Wakaf::class : Donasi::class;
        $wakaf = $model::where('id', request()->get('wakaf_id') ?: request()->get('donasi_id'))->first();
        return view('frontend::pages.payments.master', compact('order_id', 'status', 'payment', 'wakaf'));
    }

    public function get_status_payment(string $order_id)
    {
        $client = new Client();
        $url = env('MIDTRANS_API_STATUS_URL') . $order_id . '/status';
        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':')
                ]
            ]);
            $body = $response->getBody();
            $data = json_decode($body, true);
            return response()->json($data, 200);
        } catch (\Exception $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function update_status_payment(Request $request, string $order_id)
    {
        if (preg_match('/(WAKAF-|DONASI-)/', $order_id, $matches)) {
            $classes = ($matches[0] === 'WAKAF-') ? Wakaf::class : Donasi::class;
        }
        try {
            $payment = Payment::where('transaction_id', $order_id)->first();
            $payment->update(['status' => $request->status]);
            $objects = $classes::where('id', $request->campaign_id ?: $request->campaign_id)->first();
            if ($request->status == 'settlement') {
                $raised = intval($objects->raised_amount) + intval($payment->amount);
                $classes::where('id', $request->campaign_id ?: $request->campaign_id)
                    ->update(['raised_amount' => $raised]);
            }
            return response()->json([
                'status' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'failed'
            ], 500);
        }
    }
}
