<?php

namespace App\Services;

use App\Models\User;
use Exception;
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

    public function findUser(int $userId): User
    {
        return $this->user->find($userId);
    }

    public function createUser(User $user): User
    {
        if (empty($user) && !is_a($user, User::class)) {
            throw new Exception("Error when create user");
        }

        $user->password = Hash::make($user->password);
        $userSaved = $user->save();
        
        if (!$userSaved) {
            throw new Exception("User not created");
        }

        return $user;
    }

    public function updateUser(Array $params, int $userId)
    {
        $user = $this->findUser($userId);

        if ((isset($params['email'])) && !$this->_verifyEmailExist($params['email'])) {
            throw new Exception("Email already used");
        }
        
        $user->fill($params);
        $userUpdated = $user->update();

        if (!$userUpdated) {
            throw new Exception("User not updated");
        }

        return $user->only([
            'name',
            'email'
        ]);
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->findUser($userId);
        return $user->delete();
    }

    private function _verifyEmailExist(string $email)
    {
        return $this->user->whereEmail($email)->count() < 1;
    }
}