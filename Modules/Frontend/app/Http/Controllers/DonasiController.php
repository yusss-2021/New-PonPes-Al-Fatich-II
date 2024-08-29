<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Midtrans\Config;
use Midtrans\Snap;
use Modules\Admin\Models\DonasiCms;
use Modules\Admin\Models\Donasi;
use Modules\Admin\Models\Payment;
use Ramsey\Uuid\Uuid;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donasiCms = DonasiCms::first();
        $donasis = Donasi::paginate(9);
        return view('frontend::pages.donasi.index', compact('donasiCms', 'donasis'));
    }

    public function donate(string $id)
    {
        $donasi = Donasi::where('id', $id)->first();
        return view('frontend::pages.donasi.action', compact('donasi'));
    }

    public function getSnapToken(Request $request, string $id)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_ENV');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        try {
            $params = [
                'transaction_details' => [
                    'order_id' => 'DONASI-' . uniqid(),
                    'gross_amount' => $request->nominal,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_depan,
                    'last_name' => $request->nama_belakang,
                    'email' => $request->email,
                    'phone' => $request->phoneNumber,
                ]
            ];
            Payment::create([
                'id' => Uuid::uuid4()->toString(),
                'transaction_id' => $params['transaction_details']['order_id'],
                'amount' => $request->nominal,
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
