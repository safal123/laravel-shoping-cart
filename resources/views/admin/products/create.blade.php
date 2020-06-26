@extends('admin.layouts')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create new product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.products') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
<!-- general form elements -->
    <div class="card card-danger">
      <div class="card-header">
        <h3 class="card-title">
          Create new product
        </h3>
      </div>

      <form id="productForm" enctype="multipart/form-data" method="post" role="form">
        @csrf

        <div class="card-body">

          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="productName" placeholder="Enter product name">
            <span id="nameError" class="text-danger"></span>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="4" cols="50" id="productDescription" name="description" class="form-control"></textarea>
            <span id="descriptionError" class="text-danger"></span>
          </div>

          <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="productImage">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" name="image" id="productImage" class="custom-file-input">
                <label class="custom-file-label" for="productImage">Choose Product Image</label>
            </div>
            <br>
          </div>
          <span id="imageError" class="text-danger"></span>

          <div class="form-group">
            <label for="is_active">Product Category</label>
            <select class="form-control" id="productCategory" name="category_id">
                <option value="">Please select..</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
            <span id="categoryError" class="text-danger"></span>
          </div>

          <div class="form-group">
            <label for="price">Price</label>
            <input type="number" min="1" class="form-control" name="price" id="productPrice" placeholder="Product Price">
            <span id="priceError" class="text-danger"></span>
          </div>

          <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" min="1" class="form-control" name="discount" id="productDiscount" placeholder="Product Discount">
            <span id="discountError" class="text-danger"></span>
          </div>

          <div class="form-group">
            <label for="is_active">Is active?</label>
            <select name="is_active" id="product_is_active" class="form-control">
              <option value="">Please select..</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
            <!-- <input type="text" class="form-control" name="is_active" id="product_is_active" placeholder="Product Discount"> -->
            <span id="activeError" class="text-danger"></span>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="product-create btn btn-primary">Create new product</button>
        </div>
      </form>

    </div>
<!-- /.card -->

</section>

<!-- Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('extrajs')
  <script type="text/javascript">
    $(document).ready(function(){
        // custom file input show file name of selected image
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        $('#productForm').on('submit', function(event){
            event.preventDefault();
            $('.text-danger').html('');
            $.ajax({
                method: 'POST',
                url: '/admin/products/create',
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
                {
                    //alert(data.success);
                    $("#productForm")[0].reset();
                    //$('#productModal').show();
                    $('.modal-body').append(data.success);
                    $('#productModal').modal('show');
                },
                error: function(request, error)
                {
                    json = $.parseJSON(request.responseText);
                    $('.alert-danger').show();
                    var keyArray = [];
                    $.each(json.errors, function(key, value){
                        //$('.alert-danger').append('<p>'+value+'</p>');
                        keyArray.push(key);
                    });
                    //console.log(keyArray);
                    if(keyArray.includes('name')){
                        $('#nameError').append('<p>The name field is required.</p>');
                    }
                    if(keyArray.includes('description')){
                        $('#descriptionError').append('<p>The description field is required.</p>');
                    }
                    if(keyArray.includes('image')){
                        $('#imageError').append('<p>The image field is required.</p>');
                    }
                    if(keyArray.includes('category_id')){
                        $('#categoryError').append('<p>The product category field is required.</p>');
                    }
                    if(keyArray.includes('price')){
                        $('#priceError').append('<p>The price field is required</p>');
                    }
                    if(keyArray.includes('discount')){
                        $('#discountError').append('<p>The discount field is required</p>');
                    }
                    if(keyArray.includes('is_active')){
                        $('#activeError').append('<p>The active field is required</p>');
                    }
                    $("#result").html('');
                }
            });
        });
    });
  </script>
@endsection
