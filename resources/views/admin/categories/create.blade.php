@extends('admin.layouts')

@section('content')

<section class="content-header bg-white mb-4 shadow">
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
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="card-title text-info">Add New</h3>
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
        @livewire('admin.add-new-category')
    </div>
</div>

@endsection