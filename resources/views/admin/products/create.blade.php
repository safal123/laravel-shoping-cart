@extends('admin.layouts')

@section('content')

<!-- general form elements -->
  <div class="container mt-2">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">
          Create new product
        </h3>
        
      </div>
      <!-- <div id="result"></div> -->
      <div class="alert alert-danger m-2" style="display:none">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>

      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form action="{{ route('admin.products.store') }}" method="POST" id="productsForm"> -->
      <form id="productForm">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="productName" placeholder="Enter product name">
            <span id="name_error"></span>
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="4" cols="50" id="productDescription" name="description" class="form-control">
            </textarea>
            <span id="description_error"></span>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="priductImage" name="image">
                <label class="custom-file-label" for="image">Select Image</label>
              </div>
            </div>
            <span id="image_error"></span>
          </div>
          <div class="form-group">
            <label for="is_active">Product Category</label>
            <select class="form-control" id="productCategory" name="category_id">
                <option value="">Please select..</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" id="productPrice" placeholder="Product Price">
            <span id="price_error"></span>
          </div>
          <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" class="form-control" name="discount" id="productDiscount" placeholder="Product Discount">
            <span id="discount_error"></span>
          </div>
          <div class="form-group">
            <label for="is_active">Is active?</label>
            <select name="is_active" id="product_is_active" class="form-control">
              <option value="">Please select..</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
            <!-- <input type="text" class="form-control" name="is_active" id="product_is_active" placeholder="Product Discount"> -->
            <span id="is_active_error"></span>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="product-create btn btn-primary">Create new product</button>
        </div>
      </form>
      
    </div>
  </div>
<!-- /.card -->

@endsection

@section('extrajs')
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".product-create").click(function(e) {
      e.preventDefault();
      $('.alert-danger').hide();
      $('.alert-danger').html('');
      $('#cp-alert').html('');
      var name=$("input[name=name]").val();
      var category_id = $("select[name=category_id]").val();
      var description=$("textarea[name=description]").val();
      var image=$("input[name=image]").val();
      var price=$("input[name=price]").val();
      var discount=$("input[name=discount]").val();
      var is_active=$("select[name=is_active]").val();

      $.ajax({
        type: 'POST',
        url: '/admin/products/create',
        data:{
          _token: "{{ csrf_token() }}",
          name: name, 
          category_id: category_id,
          description: description, 
          image: image,
          price: price,
          discount: discount,
          is_active: is_active
        },
        success:function(data){
          alert(data.success);
          $("#productForm")[0].reset();
        },
        error: function (request, error) {
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('.alert-danger').show();
                //console.log($("#product" + key).length);
                //if($("#product" + key))
                // $("#" + key + "_error").text(value[0]);
                // $("#" + key + "_error").css("color", "red");
                if(key !==null && key == $("input[name=name]")) {
                  $(".form-control").css("border-color", "red");
                  $('.error').html(key.value).css('color', 'red');
                }
                $('.alert-danger').append('<p>'+value+'</p>');
            });
            $("#result").html('');
        }
      });
    });
  </script>
@endsection