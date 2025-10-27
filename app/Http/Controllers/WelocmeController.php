<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelocmeController extends Controller
{
    public function index(){
        $categories=  Category::orderBy("order","asc")
        ->where("is_active",true)->get();
        // dd($categories);
        return view("landing",compact("categories"));
    }
}
