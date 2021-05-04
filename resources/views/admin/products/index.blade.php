@extends('admin.layouts')

@section('content')
<section class="content-header bg-white mb-2">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Products</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ route('admin.products') }}">Products</a>
          </li>
          <li class="breadcrumb-item active">Index</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title float-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-success">Add new Product</a>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Image</th>
                <th>Product Name</th>
                <!-- <th>Description</th> -->
                <th>Is Active</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($products as $product)
              <tr>
                <td>
                  <img src="{{ url('storage/'.$product->image) }}" class="" alt="" height="100" width="100">
                  <!-- {{ $product->image }} -->
                </td>
                <td>
                  <a href="#">{{ $product->name }}</a>
                </td>
                <!-- <td>{{ $product->description }}</td> -->
                <td><span class="tag tag-success">{{ $product->is_active }}</span></td>

                <td>{{$product->price}}</td>
                <td>{{$product->discount}}</td>
                <td class="btn-group">
                  <button class="btn btn-sm btn-info">Edit</button>
                  <button class="btn btn-sm btn-danger">Delete</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
          {{ $products->links() }}
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  <!-- /.row -->
</section>

@endsection

@section('extrajs')
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection