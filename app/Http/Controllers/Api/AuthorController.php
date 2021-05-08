<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function index()
    {
        $authors = $this->author->all();
        return response()->json(['data' => $authors, 200,],);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try
        {
            $author = $this->author->create($data);
            return response()->json(['data' => ['msg' => 'Autor cadastrado com sucesso!'], 200,],);
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
            $author = $this->author->find($id);
            if(!$author)
            {
                return response()->json(['data' => ['msg' => 'Autor não encontrado']],);
            }
            $author->update($data);
            return response()->json(['data' => ['msg' => 'Autor atualizado com sucesso!'], 200,],);
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
            $author = $this->author->find($id);
            if(!$author)
            {
                return response()->json(['data' => ['msg' => 'Autor não encontrado']],);
            }
            $author->delete();
            return response()->json(['data' => ['msg' => 'Autor apagado com sucesso!'], 200,],);
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
            $author = $this->author->find($id);
            $author->books;
            if(!$author)
            {
                return response()->json(['data' => ['msg' => 'Autor não encontrado']],);
            }
            return response()->json(['data' => $author, 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }
}
