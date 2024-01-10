<?php
namespace App\Actions;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserAction
{
    public function register($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cargo_id' => 2, 
        ]);

        $token = JWTAuth::fromUser($user);

        return ['user' => $user, 'token' => $token];
    }

    public function login($credentials)
    {
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return ['error' => 'invalid_credentials'];
            }
            
        } catch (JWTException $e) {
            return ['error' => 'could_not_create_token'];
        }

        return ['token' => $token];
    }

    public function listUsers()
    {
        return User::all();
    }

    public function updateUser($userId, $data)
    {
        $user = User::find($userId);
        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            return true;
        }

        return false;
    }

    public function creatueUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'cargo_id' => $data['cargo'], 
        ]);

        $token = JWTAuth::fromUser($user);

        return ['user' => $user, 'token' => $token];
    }


}
