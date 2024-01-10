<?php

namespace App\Http\Controllers;

use App\Actions\UserAction;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $userAction;

    public function __construct(UserAction $userAction)
    {
        $this->userAction = $userAction;
        $this->middleware('admin');
    }

    public function index()
    {
        $users = $this->userAction->listUsers();
        return response()->json($users);
    }

    public function store(RegisterRequest $request)
    {
        $result = $this->userAction->creatueUser($request->validated());
        return response()->json($result, 201);
    }

    public function update(Request $request, $id)
    {
        $result = $this->userAction->updateUser($id, $request->validated());
        if ($result) {
            return response()->json(['message' => 'Usuário atualizado com sucesso', 'user' => $result]);
        }
        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }

    public function destroy($id)
    {
        if ($this->userAction->deleteUser($id)) {
            return response()->json(['message' => 'Usuário deletado com sucesso']);
        }
        return response()->json(['message' => 'Usuário não encontrado'], 404);
    }
}
