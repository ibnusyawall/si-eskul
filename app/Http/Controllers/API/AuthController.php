<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $store = $request->only(['username', 'password']);
        $check = Auth::attempt(['username' => $request->username, 'password' => $request->password]);

        if ($store && $check) {
            $user = Auth::user();

            if (Auth::check()) {
                $message = [
                    'token' => $user->createToken(env('TOKEN_CLIENT') or 'eskul')->accessToken,
                    'user' => $user,
                ];

                return response()->json($message, 200);
            } else {
                $message = [
                    "message" => "Unauthenticated.",
                ];

                return response()->json($message, 401);
            }
        } else {
            $message = [
                "message" => "Unauthenticated.",
            ];

            return response()->json($message, 401);
        }
    }

    public function logout(){}
}
