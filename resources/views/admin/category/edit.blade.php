@extends('admin.layout.adminLayout')
@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Update Category</h3>
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
        <form action="{{ route('update-category') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="row mb-3">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id" required class="form-control" id="id" value="{{ $category->id }}">
                        <input type="text" name="name" required class="form-control" id="name" value="{{ $category->name }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="image_url" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="file" name="image_url" class="form-control @error('image_url') is-invalid @enderror" id="image_url" accept="image/*">
                        </div>
                        <small class="form-text text-muted">Allowed file types: jpeg, png, jpg, gif, svg. Max size: 2MB</small>
                        @error('image_url')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        @if($category->image_url)
                            <div class="mt-3">
                                <p class="mb-2">Current Image:</p>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $category->image_url) }}" alt="Current Image" width="150" class="img-thumbnail rounded me-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remove_image" id="removeImage" value="1">
                                        <label class="form-check-label text-danger" for="removeImage">
                                            <i class="fas fa-trash-alt me-1"></i> Remove current image
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="order" class="col-sm-2 col-form-label">order</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" value="{{ $category->order}}" name="order" class="form-control" id="order">
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Activity</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="gridRadios1" value="1" {{ $category->is_active == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios1"> Active </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="gridRadios2" value="0" {{ $category->is_active == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios2"> Draft</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('admin-category') }}" class="btn btn-secondary float-end">Cancel</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Horizontal Form-->
</div>
</div>

@endsection
