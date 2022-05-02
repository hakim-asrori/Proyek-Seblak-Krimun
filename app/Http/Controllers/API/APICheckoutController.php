<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Food;
use App\Models\Purchase;
use Illuminate\Http\Request;

class APICheckoutController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);
        $validated['total'] = $request->totalCount;
        $validated['level'] = $request->levelSpicy;
        $checkout = Checkout::create($validated);

        foreach ($request->cart as $cart) {
            $food = Food::where('id', $cart['foodId'])->first();
            Purchase::create([
                'checkout_id' => $checkout->id,
                'food_id' => $food->id,
                'quantity' => $cart['quantity']
            ]);
        }

        return response()->json(1, 201);
    }
}
