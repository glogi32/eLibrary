<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $draw = $request->input("draw");
        $start = $request->input("start");
        $length = $request->input("length");
        $search = $request->input("search")['value'];
        $orderBy = $request->input("order")[0]["column"];
        $orderDir = $request->input("order")[0]["dir"];
        
        $query = Book::with("user","author");
        $recordsTotal = $query->get()->count();

        if(!empty($search)){
            $query = $query->where("title","like","%".$search."%")
            ->orWhere("book_number","like","%".$search."%")
            ->orWhereHas("author", function($query) use($search){
                return $query->where("name","like","%".$search."%")
                        ->orWhere("surname","like","%".$search."%");
            });
        }

        $orderColumn = "title";
        switch($orderBy){
            case 0:
                $orderColumn = "title";
                break;
            case 1:
                $orderColumn = "description";
                break;
            case 2:
                $orderColumn = "book_number";
                break;
            case 5:
                $orderColumn = "created_at";
                break;
            case 6:
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

        return BookResource::collection($authors)
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
    public function store(Request $request)
    {
        $book = new Book();
        $book->title = $request->input("title");
        $book->description = $request->input("description");
        $book->book_number = time();
        $book->author_id = $request->input("author");
        $book->created_by_user_id = session("user")->id;
        
        try {
            $book->save();

            return redirect()->back()->with("success",["message" => "Book successfully added."]);
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
        $book = Book::find($id);

        if(!$book){
            return response()->json(["message" => "Book not found!"],204);
        }

        try {
            $book->delete();
            $book->save();

            return response()->json('',204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "Server error, try again later"], 500);
        }
      
    }
}
