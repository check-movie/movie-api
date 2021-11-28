<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function register($request)
    {
        $user = $this->model = User::create($request->validated());

        $this->model->avatar = generateAvatar($user);

        $this->model->save();

    }

    public function login($request)
    {
        if (!$token = guard()->attempt($request->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return respondWithToken($token, $request);
    }
}





















?>
