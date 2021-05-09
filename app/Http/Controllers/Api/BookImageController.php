<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookImageController extends Controller
{
    private $bookimage;

    public function __construct(BookImage $bookimage)
    {
        $this->bookimage = $bookimage;
    }

    public function index()
    {
        $bookimages = $this->bookimage->all();
        return response()->json(['data' => $bookimages, 200,],);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try
        {
            $photo = $request->file('photo');
            $data['photo'] = $photo->store('images', 'public');
            $bookimage = $this->bookimage->create($data);
            return response()->json(['data' => ['msg' => 'Imagem cadastrada com sucesso!'], 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->only(['is_thumb']);
        try
        {
            $bookimage = $this->bookimage->find($id);
            if(!$bookimage)
            {
                return response()->json(['data' => ['msg' => 'Imagem não encontrada']],);
            }
            $oldthumb = $this->bookimage->where('book_id', $bookimage->book_id)->where('is_thumb', true)->first();
            $oldthumb->update([
                'is_thumb' => false,
            ]);
            $bookimage->update($data);
            return response()->json(['data' => ['msg' => 'Imagem atualizada com sucesso!'], 200,],);
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
            $bookimage = $this->bookimage->find($id);
            if(!$bookimage)
            {
                return response()->json(['data' => ['msg' => 'Imagem não encontrada']],);
            }
            if($bookimage->is_thumb == true)
            {
                return response()->json(['data' => ['msg' => 'Escolha outra thumb antes'], 200,],);
            }
            Storage::disk('public')->delete($bookimage->photo);
            $bookimage->delete();
            return response()->json(['data' => ['msg' => 'Imagem apagada com sucesso!'], 200,],);
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
            $bookimage = $this->bookimage->find($id);
            if(!$bookimage)
            {
                return response()->json(['data' => ['msg' => 'Imagem não encontrada']],);
            }
            $bookimage->book;
            return response()->json(['data' => $bookimage, 200,],);
        }
        catch(\Exception $e)
        {
            return response()->json(['data' => ['msg' => $e->getMessage()]],);
        }
    }
}
