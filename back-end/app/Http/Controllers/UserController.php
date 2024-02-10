<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Validation\Validator as ValidatorMessage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
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
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $validator = Validator::make($params, [
            'name'     => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|',
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors());
        }
        
        $user = UserService::convertArrToObject($params);
        UserService::createUser($user);
        
        return $params;
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function failedValidation(ValidatorMessage $validator)
    {   
        $errors = $validator->errors();
        
        $response = new JsonResponse([
            'errors' => $errors,
        ], 422);

        throw new HttpResponseException($response);
    }
}
