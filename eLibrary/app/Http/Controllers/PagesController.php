<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function home(Request $request)
    {
        $authors = Author::select("id","name","surname")->get();
        
        return view('pages.home',["authors" => $authors]);
    }

    public function authors(Request $request)
    {
        return view('pages.authors');
    }
}
