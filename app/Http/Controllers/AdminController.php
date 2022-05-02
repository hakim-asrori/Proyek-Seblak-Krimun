<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $data = [
            'app_title' => 'Dashboard'
        ];

        return view('admin.dashboard');
    }

    public function food()
    {

    }

    public function category()
    {

    }
}
