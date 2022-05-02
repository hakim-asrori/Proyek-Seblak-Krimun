<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'app_title' => 'Orderan',
            'customer' => Checkout::all()
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

    public function orderSelesai($id)
    {
        $checkout = Checkout::findOrFail($id)->delete();

        return back();
    }
}
