<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class APIFoodController extends Controller
{
    public function showAll()
    {
        $data = [
            'product' => Food::all()
        ];

        return view('landing.food', $data);
    }

    public function searchFood(Request $request)
    {
        $data = [
            'product' => Food::where('name', 'like', '%'.$request->term.'%')->get()
        ];

        return view('landing.food', $data);
    }

    public function searchCategory(Request $request)
    {
        $data = [
            'product' => Food::where('category_id', 'like', '%'.$request->term.'%')->get()
        ];

        return view('landing.food', $data);
    }
}
