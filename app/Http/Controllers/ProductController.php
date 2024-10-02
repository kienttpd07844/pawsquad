<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function all(){
        return view('clients.product.index');
    }
    public function list(Request $request){
        return view('clients.product.detail');
    }
}
