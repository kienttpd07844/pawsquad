<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $categories = Category::where('slug','!=','uncategorized')->IsParent()->IsActive()->take(8)->get();
        return view('clients.home.index',compact('categories'));
    }

}
