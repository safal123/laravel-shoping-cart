@extends('admin.layouts')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<form action="{{ route('admin.categories.store')}}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Categories</h3>
                <div class="d-flex">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-info btn-sm ml-2">View All</a>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="categoryName" placeholder="Enter Category Name">
                <span id="nameError" class="text-danger"></span>
            </div>
            <div class="form-group">
                <label for="name">Description</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
                <span id="nameError" class="text-danger"></span>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="product-create btn btn-primary">Save</button>
        </div>
</form>
</div>

@endsection