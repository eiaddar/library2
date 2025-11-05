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

    <table class="table table-striped">
        <th>id</th>
        <th>Name</th>
        <th>Order</th>
        <th>Is Active</th>
        <th>image</th>
        <th class="">Actions</th>
        <tbody>
            @foreach ($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->order }}</td>
                <td><span class="badge bg-{{$cat->is_active==1?"success":"danger"}}">{{ $cat->is_active==1?"Active":"Draft" }}</span></td>
                <td><img src="{{ asset($cat->image_url) != (env('APP_URL')."/") ? asset($cat->image_url):asset("asset/images/book1.avif")}}" width="150px"/></td>
                
                <td>
                    <a href="/admin/category/edit/{{ $cat->id }}" class="btn btn-warning">Edit</a>
                    <a href="#" data-id="{{$cat->id}}" class="btn btn-danger delete-cat">Delete</a>

                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // import Swal from 'sweetalert2';
    document.addEventListener('DOMContentLoaded', function() {
        //Swal.fire("SweetAlert2 is working!");
        document.querySelectorAll('.delete-cat').forEach(function(btn) {
            btn.addEventListener('click', function() {
                console.log(btn);
                let id= btn.getAttribute('data-id'); 
                console.log(id);
                // You can access the data-id attribute here if needed:
                // var catId = this.getAttribute('data-id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                       
                        window.location.href= "{{ env('APP_URL') }}"+'/admin/category/delete/'+id;
                    }
                });
            });
        });
    });

    function confirmDelete(id) {

        // if(confirm("are you sure you want to delete?")==true){
        //     window.location.href= "{{ env('APP_URL') }}"+'/admin/category/delete/'+id;
        // }


    }
</script>
@endsection