@extends('admin.layouts')

@section('content')

<!-- general form elements -->
  <div class="container mt-2">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Create new product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <!-- <form action="{{ route('admin.products.store') }}" method="POST" id="productsForm"> -->
      <form>
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter product name">
          </div>
          <div class="form-group">
            <label for="description">Description</label>
            <textarea rows="4" cols="50" name="description" class="form-control">
            </textarea>
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="priductImage" name="image">
                <label class="custom-file-label" for="image">Select Image</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" id="productPrice" placeholder="Product Price">
          </div>
          <div class="form-group">
            <label for="discount">Discount</label>
            <input type="text" class="form-control" name="discount" id="productDiscount" placeholder="Product Discount">
          </div>
          <div class="form-group">
            <label for="is_active">Is active?</label>
            <input type="text" class="form-control" name="is_active" id="product_is_active" placeholder="Product Discount">
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
      var name=$("input[name=name]").val();
      var description=$("textarea[name=description]").val();
      var image=$("input[name=image]").val();
      var price=$("input[name=price]").val();
      var discount=$("input[name=discount]").val();
      var is_active=$("input[name=is_active]").val();

      $.ajax({
        type: 'POST',
        url: '/admin/products/create',
        data:{
          "_token": "{{ csrf_token() }}",
          name: name, 
          description: description, 
          image: image,
          price: price,
          discount: discount,
          is_active: is_active
        },
        success:function(data){
          alert(data.success);
        }
      });
    });
  </script>
@endsection