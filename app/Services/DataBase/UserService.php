<?php

namespace App\Services\DataBase;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register($data)
    {
        $data['password'] = Hash::make($data['password']);
        $this->userRepository->create($data);
    }

    public function login($credentials)
    {
        $user = $this->userRepository->findByEmail($credentials['email']);
        if ($user && Hash::check($credentials['password'], $user->password)) {
            auth()->login($user);
            return true;
        }
        return false;
    }
}
