<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function in(Request $request)
    {
        DB::beginTransaction();

        $post = Validator::make($request->all(), [
            'account' => 'required|max:15',
            'password' => 'required|min:8|max:50',
        ]);

        if ($post->fails()) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Data yang dikirim tidak sesuai"
            ]);
        }

        $user = $this->user->where("phone", $request->account)->first();
        if (!$user) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Akun tidak ditemukan"
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Akun tidak ditemukan"
            ]);
        }

        try {
            $user->x_auth = $user->createToken('api', ['authenticated'])->plainTextToken;

            DB::commit();
            return response()->json([
                "ResponseCode" => Response::HTTP_OK,
                "Messages" => "Anda berhasil Sign In",
                "Data" => $user
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "ResponseCode" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "Messages" => $th->getMessage()
            ]);
        }
    }

    public function up(Request $request)
    {
        DB::beginTransaction();

        $post = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'phone' => 'required|max:15|unique:users,phone',
            'password' => 'required|min:8|max:50',
            'address' => 'required|max:150',
        ]);

        if ($post->fails()) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Data yang dikirim tidak sesuai"
            ]);
        }

        $request->merge([
            "password" => Hash::make($request->password)
        ]);

        try {
            $this->user->create($request->all());

            DB::commit();
            return response()->json([
                "ResponseCode" => Response::HTTP_OK,
                "Messages" => "Akun berhasil dibuat. Silahkan lakukan Sign In."
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "ResponseCode" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "Messages" => $th->getMessage()
            ]);
        }
    }
}
