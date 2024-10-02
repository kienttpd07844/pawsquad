<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function all(){
        return view('clients.blog.index');
    }
    public function detail(){
        return view('clients.blog.detail');
    }

}
