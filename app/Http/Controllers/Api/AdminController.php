<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index()
    {
        $admins = $this->admin->all();
        return response()->json(['data' => $admins, 200,],);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try
        {
            $data['password'] = bcrypt($data['password']);
            $admin = $this->admin->create($data);
            return response()->json(['data' => ['msg' => 'Administrador cadastrado com sucesso!'], 200,],);
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
            $admin = $this->admin->find($id);
            if(isset($data['password']))
            {
                $data['password'] = bcrypt($data['password']);
            } 
            if(!$admin)
            {
                return response()->json(['data' => ['msg' => 'Administrador não encontrado']],);
            }
            $admin->update($data);
            return response()->json(['data' => ['msg' => 'Administrador atualizado com sucesso!'], 200,],);
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
            $admin = $this->admin->find($id);
            if(!$admin)
            {
                return response()->json(['data' => ['msg' => 'Administrador não encontrado']],);
            }
            $admin->delete();
            return response()->json(['data' => ['msg' => 'Administrador apagado com sucesso!'], 200,],);
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
            $admin = $this->admin->find($id);
            if(!$admin)
            {
                return response()->json(['data' => ['msg' => 'Administrador não encontrado']],);
            }
            return response()->json(['data' => $admin, 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }
}
