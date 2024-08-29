<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Midtrans\Config;
use Midtrans\Snap;
use Modules\Admin\Models\WakafCms;
use Modules\Admin\Models\Donatur;
use Modules\Admin\Models\Payment;
use Modules\Admin\Models\Wakaf;
use Ramsey\Uuid\Uuid;

class WakafController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wakafCms = WakafCms::first();
        $wakafs = Wakaf::where('end_date', '>=', Carbon::now())
            ->paginate(9);
        return view('frontend::pages.wakaf.index', compact('wakafCms', 'wakafs'));
    }


    /**
     * Display a listing of the resource.
     */
    public function donate(string $id)
    {
        $wakaf = Wakaf::where('id', $id)->first();
        return view('frontend::pages.wakaf.action', compact('wakaf'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $wakaf = Wakaf::where('id', $id)->first();
        $donaturs = Donatur::where('wakaf_id', $id)
            ->with('payment')
            ->withWhereHas('payment', fn($query) => $query->where('status', 'settlement'))
            ->paginate(10);
        return view('frontend::pages.wakaf.show', compact('wakaf', 'donaturs'));
    }

    public function getSnapToken(Request $request, string $id)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_ENV');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $wakaf = Wakaf::where('id', $id)->first();

        try {
            $params = [
                'transaction_details' => [
                    'order_id' => 'WAKAF-' . uniqid(),
                    'gross_amount' => $request->nominal,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_depan,
                    'last_name' => $request->nama_belakang,
                    'email' => $request->email,
                    'phone' => $request->phoneNumber,
                ]
            ];

            $payment = Payment::create([
                'id' => Uuid::uuid4()->toString(),
                'transaction_id' => $params['transaction_details']['order_id'],
                'amount' => $request->nominal,
            ]);
            Donatur::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => "{$request->nama_depan} {$request->nama_belakang}",
                'email' => $request->email,
                'phone' => $request->phoneNumber,
                'wakaf_id' => $wakaf->id,
                'payment_id' => $payment->id,
                'show_hamba_allah' => $request->is_hamba
            ]);
            $token = Snap::getSnapToken($params);

            return response()->json([
                'status' => 200,
                'data' => $token
            ], 200);
        } catch (\Exception $th) {
            return response()->json([
                'status' => 500,
                'token' => null,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
