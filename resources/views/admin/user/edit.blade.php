@extends('admin.layout.adminLayout')
@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Update user</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
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
        <form action="{{ route('update-user') }}" method="post" enctype="multipart/form-data">
            @csrf
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="id" required class="form-control" id="id" value="{{ $user->id }}">
                        <input type="text" name="name" required class="form-control" id="name" value="{{ $user->name }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="image_url" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="file" name="profile_image" class="form-control @error('image_url') is-invalid @enderror" id="image_url" accept="image/*">
                        </div>
                        <small class="form-text text-muted">Allowed file types: jpeg, png, jpg, gif, svg. Max size: 2MB</small>
                        @error('image_url')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        @if($user->profile_image)
                            <div class="mt-3">
                                <p class="mb-2">Current Image:</p>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="Current Image" width="150" class="img-thumbnail me-3">
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
                <div class="mb-3 row">
                    <label for="order" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email"  value="{{ $user->email}}" name="email" class="form-control" id="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" value="" name="password" class="form-control" id="password" autocomplete="new-password" autofill="off">
                    </div>
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
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="roles[]" 
                                       id="role{{ $role->id }}" value="{{ $role->id }}"
                                       {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
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
                
                <fieldset class="mb-3 row">
                    <legend class="pt-0 col-form-label col-sm-2">Activity</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="gridRadios1" value="1" {{ $user->is_active == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios1"> Active </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="gridRadios2" value="0" {{ $user->is_active == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gridRadios2"> Draft</label>
                        </div>
                    </div>
                </fieldset>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Save</button>
                <a href="{{ route('admin-user') }}" class="btn btn-secondary float-end">Cancel</a>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Horizontal Form-->
</div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rolesToggle = document.getElementById('rolesToggle');
        const rolesSection = document.getElementById('rolesSection');
        
        // Toggle roles section visibility
        function toggleRolesSection() {
            rolesSection.style.display = rolesToggle.checked ? 'flex' : 'none';
        }
        
        // Initialize and add event listener
        toggleRolesSection();
        rolesToggle.addEventListener('change', toggleRolesSection);
    });
</script>
@endpush

@endsection
