<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Response\Response;
use App\Models\User;
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
    use Response;
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
        ],
        [
            'name.required' => "Nome é obrigatório",
            'name.string'   => "Nome precisa ser um texto",
            'email.required'=> "Email é obrigatório",
            'email.email'   => "Formato de email invalido",
            'password.required' => "Senha é obrigatório",
        ]
    
        );
        
        $user = UserService::convertArrToObject($params);
        $response = UserService::createUser($user);
        if (is_array($response) && array_key_exists('message', $response)) {
            return self::error(options: $response);
        }
        
        return self::success(options: [
            'message' => 'Usuário cadastrado com sucesso!'
        ]);
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

    private function _validateRequest(Request $request, Array $rules, $messages)
    {
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            throw ValidationException::withMessages([
                $validator->errors()
            ]);
        }

        return $request->all();
    }
}
