<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Food;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class APICheckoutController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        $reference = "INV/" . date("Y-m/") . mt_rand(000000, 999999);

        $request->merge([
            'total' => $request->totalCount,
            'status' => Checkout::PENDING,
            'user_id' => auth()->user()->id,
            'reference' => $reference
        ]);

        $validated = Validator::make($request->all(), [
            'service' => 'required',
            'totalCount' => 'required|numeric',
            'cart' => 'required|array'
        ]);

        if ($validated->fails()) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Data yang dikirim tidak sesuai",
            ]);
        }

        try {
            $checkout = Checkout::create($request->except('totalCount', 'cart'));

            foreach ($request->cart as $cart) {
                $food = Food::where('id', $cart['foodId'])->first();
                Purchase::create([
                    'checkout_id' => $checkout->id,
                    'food_id' => $food->id,
                    'quantity' => $cart['quantity']
                ]);
            }

            DB::commit();
            return response()->json([
                "ResponseCode" => Response::HTTP_CREATED,
                "Messages" => "Data berhasil disimpan",
                "Data" => $this->formatMessage($checkout, $request)
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "ResponseCode" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "Messages" => $th->getMessage()
            ]);
        }
    }

    protected function formatMessage($checkout, $request)
    {
        $messages = array();
        $messages[] = "## Pesanan " . $checkout->reference . " ##";
        $messages[] = "";
        foreach ($request->cart as $cart) {
            $subtotal = intval($cart['quantity']) * intval($cart['price']);
            $messages[] = $cart['title'];
            $messages[] = $cart['quantity'] . " x " . number_format($cart['price'], 0, ",", ".") . str_pad(" ", 3, " ", STR_PAD_LEFT) . number_format($subtotal, 0, ",", ".");
        }
        $messages[] = "";
        $messages[] = "Total Pembelian: " . number_format($checkout->total, 0, ",", ".");
        $messages[] = "Order Via: " . $checkout->service == 1 ? "Udara" : "Laut";

        $implodeMessage = implode("\r\n", $messages);
        $implodeMessage = urlencode($implodeMessage);

        return "https://api.whatsapp.com/send?phone=6289674614096&text=$implodeMessage";
    }
}
