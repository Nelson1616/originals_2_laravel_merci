<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();
        return response()->json(['data' => $users, 200,],);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try
        {
            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            return response()->json(['data' => ['msg' => 'Usuário cadastrado com sucesso!'], 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        try
        {
            $user = $this->user->find($id);
            if(isset($data['password']))
            {
                $data['password'] = bcrypt($data['password']);
            } 
            if(!$user)
            {
                return response()->json(['data' => ['msg' => 'Usuário não encontrado']],);
            }
            $user->update($data);
            return response()->json(['data' => ['msg' => 'Usuário atualizado com sucesso!'], 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }

    public function destroy($id)
    {
        try
        {
            $user = $this->user->find($id);
            if(!$user)
            {
                return response()->json(['data' => ['msg' => 'Usuário não encontrado']],);
            }
            $user->delete();
            return response()->json(['data' => ['msg' => 'Usuário apagado com sucesso!'], 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }

    public function show($id)
    {
        try
        {
            $user = $this->user->find($id);
            if(!$user)
            {
                return response()->json(['data' => ['msg' => 'Usuário não encontrado']],);
            }
            return response()->json(['data' => $user, 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }
}
