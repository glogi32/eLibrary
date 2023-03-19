<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
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
        
        $query = User::with("role","user");
        $recordsTotal = $query->get()->count();

        if(!empty($search)){
            $query->where("name","like","%".$search."%")
            ->orWhere("surname","like","%".$search."%")
            ->orWhere("email","like","%".$search."%")
            ->orWhereHas("role",function($query) use($search){
                return $query->where("name","like","%".$search."%");
            });
        }

        $orderColumn = "created_at";
        switch($orderBy){
            case 0:
                $orderColumn = "name";
                break;
            case 1:
                $orderColumn = "surname";
                break;
            case 2:
                $orderColumn = "email";
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
            $users = $query->skip($start)->take($length)->get();
        }else{
            $users = $query->get();
        }

        return UserResource::collection($users)
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
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->input("name");
        $user->surname = $request->input("surname");
        $user->email = $request->input("email");
        $user->password = md5($request->input("pass"));
        $user->role_id = $request->input("role");
        $user->created_by_user_id = session("user")->id;
        
        try {
            $user->save();

            return redirect()->back()->with("success",["message" => "User successfully added."]);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return redirect()->back()->with("error",["message" => "Server error, try again later."]);
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
        $user = User::find($id);

        if(!$user){
            return response()->json(["message" => "User not found!"],204);
        }

        try {
            $user->delete();
            $user->save();

            return response()->json('',204);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(["message" => "Server error, try again later"], 500);
        }
    }
}
