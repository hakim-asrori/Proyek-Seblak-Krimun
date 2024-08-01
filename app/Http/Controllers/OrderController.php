<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'app_title' => 'Orderan',
            'customer' => Checkout::whereIn('status', [1, 2, 3])->orderBy('created_at', 'desc')->get()
        ];

        return view('order.index', $data);
    }

    public function faktur($id)
    {
        $data = [
            'checkout' => Checkout::where('id', $id)->first()
        ];

        return view('faktur.index', $data);
    }

    public function changeStatus(Request $request, $id)
    {
        DB::beginTransaction();

        $checkout = Checkout::find($id);
        if (!$checkout) {
            return response()->json(['Messages' => 'Data tidak ditemukan.'], 400);
        }

        try {
            $checkout->update([
                'status' => $request->status
            ]);

            DB::commit();
            return response()->json(['Messages' => 'Success'], 200);
        } catch (\Throwable $th) {
            DB::commit();
            return response()->json(['Messages' => $th->getMessage()], 500);
        }
    }
}
