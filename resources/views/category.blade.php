@extends('layout')
@section('content')

<h1>Category: {{$category->name}}</h1>
<!-- end carousel -->
<!-- library welcome cats -->
<div class="container mt-5">
    <div class="row">
        @foreach ($category->books as $book )
        <div class="col mb-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset($book->image_url) != (env('APP_URL')."/") ? asset($book->image_url):asset("asset/images/book1.avif")}}" class="card-img-top" alt="{{asset("asset/images/book1.avif")}}">
                <div class="card-body">
                    <h5 class="card-title">{{$book->name}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{env('APP_URL')."/category"."/".$book->id}}" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
<!-- end library welcome cats -->

@endsection