<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidatorMessage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @api /api/users
     */
    public function index()
    {
        // return response()->json(UserService::getUser());
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @api /api/users
     * 
     * @method POST
     */
    public function store(Request $request)
    {
        $params = $this->_validateRequest($request, [
            'name'     => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|',
        ]);
        
        $user = UserService::convertArrToObject($params);
        UserService::createUser($user);
        
        return $user;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $userId, Request $request)
    {
        if (!$userId) {
            throw new Exception('User id not informed!');
        }

        $params = $this->_validateRequest($request, [
            'name'  => 'string',
            'email' => 'email'
        ]);

        $user = UserService::updateUser($params, $userId);
        
        return response()->json([
            'message' => 'User updated with success',
            'user'    => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $userId)
    {
        if (!$userId) {
            throw new Exception('User id not informed!');
        }

        $user = UserService::deleteUser($userId);
        return response()->json([
            'message' => 'User deleted with success'
        ]);
    }


    // PRIVATE METHODS

    private function _validateRequest(Request $request, Array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                'messages' => [
                    $validator->errors()
                ]
            ]);
        }

        return $request->all();
    }
}
