<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index()
    {
        $data = [
            'app_title' => 'Rekap Data',
            'rekap' => Checkout::all()
        ];
        return view('rekap.index', $data);
    }
}
