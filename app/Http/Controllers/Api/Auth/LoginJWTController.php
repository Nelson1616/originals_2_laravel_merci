<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginJWTController extends Controller
{
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only(['name', 'password']);
        if(!$token = JWTAuth::attempt($credentials))
        {
            return response()->json(['data' => ['msg' => 'Não autorizado.']], 401);
        }
        return response()->json([
            'token' => $token,
        ]);
    }

    public function logoutAdmin()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'msg' => 'Tchau!',
        ]);
    }

    public function refreshAdmin()
    {
        $token = JWTAuth::refresh(JWTAuth::getToken());

        return response()->json([
            'token' => $token,
        ]);

    }
}
