<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->all());
        $draw = $request->input("draw");
        $start = $request->input("start");
        $length = $request->input("length");
        $search = $request->input("search")['value'];
        $orderBy = $request->input("order")[0]["column"];
        $orderDir = $request->input("order")[0]["dir"];
        
        $query = Author::with("user");
        $recordsTotal = $query->get()->count();

        if(!empty($search)){
            $query->where("name","like","%".$search."%")
            ->orWhere("surname","like","%".$search."%");
        }

        $orderColumn = "name";
        switch($orderBy){
            case 1:
                $orderColumn = "name";
                break;
            case 2:
                $orderColumn = "surname";
                break;
            case 4:
                $orderColumn = "created_at";
                break;
            case 5:
                $orderColumn = "updated_at";
                break;
        }

        $query = $query->orderBy($orderColumn,$orderDir);

        $recordsFiltered = count($query->get());
        if($length != -1){
            $authors = $query->skip($start)->take($length)->get();
        }else{
            $authors = $query->get();
        }
        
        return AuthorResource::collection($authors)
                                ->additional([
                                    "draw" => $draw,
                                    "recordsTotal" => $recordsTotal,
                                    "recordsFiltered" => $recordsFiltered
                                ]);
      
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        $author = new Author();

        $author->name = $request->input("name");
        $author->surname = $request->input("surname"); 
     
        if(session()->has("user")){
            $author->created_by_user_id = session("user")->id;
        }
        $fileImage = $request->file("image");  

        if($fileImage){
            $fileName = time()."_".$fileImage->getClientOriginalName();
            $directory = \public_path()."/img/authors/";
            $path = "img/authors/".$fileName;

            $fileUpload = $fileImage->move($directory,$fileName);

            $author->src = $path;
            $author->alt = $fileName;
        }

        
        try {
            $author->save();

            return redirect()->back()->with("success",["message" => "Author successfully added."]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with("error",["message" => "Server error, try again later."])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if(!$author){
            return response()->json(["message" => "Author not fount"],404);
        }

        try {
            $author->delete();
            $author->save();

            return response()->json('',204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "Server error, try again later"], 500);
        }

        
    }
}
