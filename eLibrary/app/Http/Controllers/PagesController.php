<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function authors(Request $request)
    {
        return view('pages.authors');
    }
}
