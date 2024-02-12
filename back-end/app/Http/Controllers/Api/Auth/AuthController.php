<?php

namespace App\Http\Controllers\Api\Auth;

use App\AuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Response\Response;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use Response;

    public function login(AuthRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        $user->tokens()->delete();
        $token = $user->createToken($request->email)->plainTextToken;
        
        $options = [
            'message' => 'Token generate with success',
            'token'   => $token
        ];
        return self::success(options: $options);
    }
}
