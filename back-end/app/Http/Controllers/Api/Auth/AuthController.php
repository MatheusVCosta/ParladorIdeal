<?php

namespace App\Http\Controllers\Api\Auth;

use App\AuthRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        // Logout others devices
        // if ($request->has('logout_other_devices'))
        $user->tokens()->delete();

        $token = $user->createToken($request->email)->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
}
