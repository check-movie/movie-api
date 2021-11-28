<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;

class AuthController extends Controller
{

    private $user;

    public function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function register(RegisterUserRequest $request)
    {
        $this->user->register($request);
    }

    public function login(LoginUserRequest $request)
    {
        return $this->user->login($request);
    }
}
