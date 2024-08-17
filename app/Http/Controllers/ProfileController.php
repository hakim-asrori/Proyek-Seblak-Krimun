<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);

        $data = [
            "user" => $user
        ];

        return view('landing.profile', $data);
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        $post = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'phone' => ['required', 'max:15', Rule::unique('users')->ignore(auth()->user()->id)],
            'address' => 'required|max:150',
        ]);

        if ($post->fails()) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Data yang dikirim tidak sesuai"
            ]);
        }

        $user = User::findOrFail(auth()->user()->id);

        try {
            $user->update($request->only(['name', 'phone', 'address']));

            DB::commit();
            return response()->json([
                "ResponseCode" => Response::HTTP_OK,
                "Messages" => "Data berhasil disimpan",
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                "ResponseCode" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "Messages" => $th->getMessage()
            ]);
        }
    }

    public function changePassword()
    {
        $data = [];

        return view('landing.change-password', $data);
    }

    public function processChangePassword(Request $request)
    {
        DB::beginTransaction();

        $validated = Validator::make($request->all(), [
            'current_password' => 'required|max:100',
            'new_password' => 'required|min:8|max:100|same:confirm_password',
            'confirm_password' => 'required|min:8|max:100|same:new_password'
        ]);

        if ($validated->fails()) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Data yang dikirim tidak sesuai",
            ]);
        }

        $user = User::findOrFail(auth()->user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                "ResponseCode" => Response::HTTP_BAD_REQUEST,
                "Messages" => "Password lama salah",
            ]);
        }

        try {
            $user->update([
                'password' => Hash::make($request->confirm_password)
            ]);

            DB::commit();
            return response()->json([
                "ResponseCode" => Response::HTTP_OK,
                "Messages" => "Data berhasil disimpan",
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
