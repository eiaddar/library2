<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function store(Request $request){

    }
    public function getbook(Request $request){
        $book = Book::findOrFail($request->id);

        return response()->json($book,200);
    }
}

