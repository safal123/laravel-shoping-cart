@extends('admin.layouts')

@section('content')

<section class="content-header bg-white mb-4 shadow">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.categories.index') }}">Categories</a>
                    </li>
                    <li class="breadcrumb-item active">Index</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Categories</h3>
                        <div class="d-flex">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-info btn-sm ml-2">Add new category</a>
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
                    <table class="table" id="category_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-sm btn-info" id="btnUpdate" onClick="handleCategoryUpdate({{ $category }})">Update</button>
                                        <button class="btn btn-sm btn-danger" id="btnDelete" onclick="handleCategoryDelete({{ $category->id }})">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Update -->
<div class="modal fade" id="categoryUpdate" tabindex="-1" role="dialog" aria-labelledby="categoryUpdateModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryUpdateModelLabel">Update category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="updateCategoryForm">
                @csrf
                <div class="modal-body">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <label for="description">Deacription</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Update</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="categoryDelete" tabindex="-1" role="dialog" aria-labelledby="categoryDeleteModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteCategoryForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryDeleteModelLabel">Delete Category ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this category?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection

@section('extrajs')

<script type="text/javascript">
    function handleCategoryUpdate(category) {
        $('#categoryUpdate').modal('show');
        var form = document.getElementById('updateCategoryForm');
        $('#name').val(category.name);
        $('#description').val(category.description);
        $('#updateCategoryForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: '/admin/categories/' + category.id,
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#categoryUpdate').modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    alert(data.error);
                }
            });
        });
    }

    function handleCategoryDelete($id) {
        $('#categoryDelete').modal('show');
        var form = document.getElementById('deleteCategoryForm');
        $('#deleteCategoryForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                method: 'POST',
                url: '/admin/categories/' + $id,
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $('#categoryDelete').modal('hide');
                    window.location.reload();
                },
                error: function(data) {
                    console.log(data);
                    alert(data.message);
                }
            });
        });

    }
</script>

@endsection