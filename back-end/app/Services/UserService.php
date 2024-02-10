<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserService
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function convertArrToObject(array $userArray)
    {
        return $this->user->fill($userArray);
    }

    public function getUser()
    {
        
    }

    public function createUser(User $user): User
    {
        if (empty($user) && is_a($user, User::class)) {
            throw new Exception("Error when create user");
        }

        $user->password = Hash::make($user->password);
        $userSaved = $user->save();
        
        if (!$userSaved) {
            throw new Exception("User not created");
        }

        return $user;
    }

    public function updateUser()
    {

    }

    public function deleteUser()
    {

    }
}