@extends('admin.layout.adminLayout')
@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Category</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">category</li>
        </ol>
    </div>
</div>
<!--end::Row-->
<div class="row">
    <div class="col-lg-2">
        <a href="{{ route('add-category') }}" class="btn btn-primary">Add Category</a>
    </div>
</div>
<div class="col-lg-12">


    <!--begin::Horizontal Form-->
    <div class="card card-warning card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">New Category</div>
        </div>
        <!--end::Header-->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!--begin::Form-->
        <form action="{{ route('store-category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="Image_url" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" name="image_url" class="form-control" id="image_url" value="{{ old('image_url') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" required class="form-control" id="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="order" class="col-sm-2 col-form-label">order</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" value="{{ old('order') }}" name="order" class="form-control" id="order">
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Activity</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="gridRadios1" value="1">
                            <label class="form-check-label" for="gridRadios1"> Active </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="gridRadios2" value="0" checked="">
                            <label class="form-check-label" for="gridRadios2"> Draft</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <button type="submit" class="btn float-end">Cancel</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Horizontal Form-->
</div>
</div>

@endsection