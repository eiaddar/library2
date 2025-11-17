@extends('admin.layout.adminLayout')
@section('content')

<!--begin::Row-->
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">user</h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">user</li>
        </ol>
    </div>
</div>
<!--end::Row-->

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="mb-3 row">
    <div class="col-lg-2">
        <a href="{{ route('add-user') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add user
        </a>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input status-toggle" type="checkbox"
                                           data-id="{{ $user->id }}"
                                           {{ $user->status ? 'checked' : '' }}>
                                    <label class="form-check-label ms-2">
                                        <span class="badge bg-{{ $user->status ? 'success' : 'danger' }}">
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                @if($user->profile_image && Storage::disk('public')->exists('profile_images/'.$user->profile_image))
                                    <img src="{{ asset('storage/profile_images/' . $user->profile_image) }}" alt="{{ $user->name }}" class="img-thumbnail" width="80">
                                @else
                                    <img src="{{ asset('asset/images/user-icon.png') }}" alt="Default Image" class="img-thumbnail" width="80">
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('edit-user', $user->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        Edit
                                        <i class="fas fa-edit"></i>
                                    </a>
                                        <button type="submit" class="btn btn-danger btn-sm delete-user"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                title="Delete">
                                                Delete
                                            <i class="fas fa-trash"></i>
                                        </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="deleteForm" action="" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle status toggle
        document.querySelectorAll('.status-toggle').forEach(toggle => {
            toggle.addEventListener('change', function() {
                const userId = this.getAttribute('data-id');
                const isActive = this.checked;
                const statusBadge = this.closest('tr').querySelector('.badge');
                const button = this;

                // Show loading state
                button.disabled = true;

                // Send AJAX request
                fetch(`/admin/user/toggle-status/${userId}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                    console.log(data);

                        // Update UI
                        statusBadge.className = `badge bg-${data.is_active ? 'success' : 'danger'}`;
                        statusBadge.textContent = data.is_active ? 'Active' : 'Inactive';

                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false
                        });
                    } else {
                        // Revert toggle if there was an error
                        button.checked = !isActive;
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    button.checked = !isActive;
                    Swal.fire('Error', 'An error occurred while updating the status', 'error');
                })
                .finally(() => {
                    button.disabled = false;
                });
            });
        });

        // Handle delete button click
        document.querySelectorAll('.delete-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                const userName = this.getAttribute('data-name');
                const form = document.getElementById('deleteForm');

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete "${userName}". This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Set the form action and submit
                        form.action = `/admin/user/delete/${userId}`;
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
