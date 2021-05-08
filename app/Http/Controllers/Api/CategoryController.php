<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->all();
        return response()->json(['data' => $categories, 200,],);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try
        {
            $category = $this->category->create($data);
            return response()->json(['data' => ['msg' => 'Categoria cadastrada com sucesso!'], 200,],);
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
            $category = $this->category->find($id);
            if(!$category)
            {
                return response()->json(['data' => ['msg' => 'Categoria não encontrada']],);
            }
            $category->update($data);
            return response()->json(['data' => ['msg' => 'Categoria atualizada com sucesso!'], 200,],);
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
            $category = $this->category->find($id);
            if(!$category)
            {
                return response()->json(['data' => ['msg' => 'Categoria não encontrada']],);
            }
            $category->delete();
            return response()->json(['data' => ['msg' => 'Categoria apagada com sucesso!'], 200,],);
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
            $category = $this->category->find($id);
            if(!$category)
            {
                return response()->json(['data' => ['msg' => 'Categoria não encontrada']],);
            }
            return response()->json(['data' => $category, 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }
}
