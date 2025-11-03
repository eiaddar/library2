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
        <th class="">Actions</th>
        <tbody>
            @foreach ($categories as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->name }}</td>
                <td>{{ $cat->order }}</td>
                <td><span class="badge bg-{{$cat->is_active==1?"success":"danger"}}">{{ $cat->is_active==1?"Active":"Draft" }}</span></td>
                <td>
                    <a href="/category/edit/{{ $cat->id }}" class="btn btn-warning">Edit</a>
                    <a href="/category/delete/{{ $cat->id }}" class="btn btn-danger">Delete</a>
                
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection