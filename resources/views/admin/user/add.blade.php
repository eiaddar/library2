@extends('admin.layout.adminLayout')
@section('content')

    <!--begin::Row-->
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">user</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">user</li>
            </ol>
        </div>
    </div>
    <!--end::Row-->
    <div class="row">
        <div class="col-lg-2">
            <a href="{{ route('add-user') }}" class="btn btn-primary">Add user</a>
        </div>
    </div>
    <div class="col-lg-12">


        <!--begin::Horizontal Form-->
        <div class="mb-4 card card-warning card-outline">
            <!--begin::Header-->
            <div class="card-header">
                <div class="card-title">New user</div>
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
            <form action="{{ route('store-user') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!--begin::Body-->
                <div class="card-body">
                    <div class="mb-3 row">
                        <label for="profile_image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="profile_image" class="form-control" id="profile_image"
                                value="{{ old('profile_image') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" required class="form-control" id="name"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                      <div class="mb-3 row">
                    <label for="order" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email"  value="{{old('email')}}" name="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" value="" name="password" class="form-control" id="password" autocomplete="new-password" autofill="off">
                    </div>
                </div>
                    <fieldset class="mb-3 row">
                        <legend class="pt-0 col-form-label col-sm-2">Activity</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="gridRadios1"
                                    value="1">
                                <label class="form-check-label" for="gridRadios1"> Active </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="gridRadios2"
                                    value="0" checked="">
                                <label class="form-check-label" for="gridRadios2"> Draft</label>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="mb-3 row">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="rolesToggle" checked>
                            <label class="form-check-label" for="rolesToggle">Manage Roles</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row" id="rolesSection">
                    <label class="col-sm-2 col-form-label">Roles</label>
                    <div class="col-sm-10">
                        @foreach ($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" id="role{{ $role->id }}"
                                    value="{{ $role->id }}">
                                <label class="form-check-label" for="role{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('roles')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
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
