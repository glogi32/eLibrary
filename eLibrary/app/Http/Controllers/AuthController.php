<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request){
        
        $email = $request->input("email");
        $password = $request->input("password");

        try {
            $user = User::with("role")->where([
                ["email","=",$email],
                ["password","=",$password]
            ])->first();

            if(!empty($user)){
                session()->put("user",$user);
                return redirect("/")->with("success",["title" => "Success: ","message" => "Login is successful."]);
            }
            else{
                return redirect("/login")->with("error",["title" => "Error login: ","message" => "Wrong credentials."]);
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect("/login")->with("error",["title" => "Error: ","message" => "Server error, try again later."]);
        }
    }

    public function logout()
    {
        if(session()->has("user")){
            session()->forget("user");
        }
        
        return redirect("/login");
    }
}
