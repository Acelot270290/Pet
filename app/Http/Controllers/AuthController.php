<?php

namespace App\Http\Controllers;

use App\Actions\UserAction;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    protected $userAction;

    public function __construct(UserAction $userAction)
    {
        $this->userAction = $userAction;
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->userAction->register($request->validated());

        return response()->json($result, 201);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->userAction->login($request->only('email', 'password'));

        return response()->json($result, 200);
    }

    
}
