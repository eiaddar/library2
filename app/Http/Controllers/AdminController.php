<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole("admin")) {
            return view("admin/layout/adminLayout");
        } else {
            return redirect("/");
        }
    }
}
