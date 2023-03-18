<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
        //
    }
}
