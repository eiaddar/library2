@extends('layout')

@section('content')

<!-- start carousel -->


<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset('asset/images/image1.avif')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Welcome to My Librry</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('asset/images/image2.avif')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{asset('asset/images/image1.avif')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- end carousel -->
<!-- library welcome cats -->
<div class="container mt-5">
    <div class="row">
        @foreach ($categories as $cat )
        <div class="col mb-3">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset($cat->image_url) != (env('APP_URL')."/") ? asset($cat->image_url):asset("asset/images/book1.avif")}}" class="card-img-top" alt="{{asset("asset/images/book1.avif")}}">
                <div class="card-body">
                    <h5 class="card-title">{{$cat->name}}</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="{{env('APP_URL')."/category"."/".$cat->id}}" class="btn btn-primary">Explore {{ $cat->name }} Books</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>


@endsection
