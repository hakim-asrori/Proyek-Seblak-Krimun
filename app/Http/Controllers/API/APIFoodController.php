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
            'product' => Food::withCount('purchases')->orderBy('purchases_count', 'desc')->paginate(8, ['*'], 'page', request('page', 1))
        ];

        return view('landing.food', $data);
    }

    public function searchFood(Request $request)
    {
        $data = [
            'product' => Food::where('name', 'like', '%' . $request->term . '%')->paginate(8, ['*'], 'page', request('page', 1))
        ];

        return view('landing.food', $data);
    }

    public function searchCategory(Request $request)
    {
        $data = [
            'product' => Food::where('category_id', 'like', '%' . $request->term . '%')->get()
        ];

        return view('landing.food', $data);
    }
}
