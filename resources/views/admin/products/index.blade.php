@extends('admin.layouts')

@section('content')
  <!-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">All Products</a></li>
      <li class="breadcrumb-item active" aria-current="page">All Products</li>
    </ol>
  </nav> -->

<!-- /.row -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            All Products
            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-success">Add new Product</a>
          </h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
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
                <td>{{ $product->id }}</td>
                <td>
                <a href="#">{{ $product->name }}</a></td>
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

@endsection