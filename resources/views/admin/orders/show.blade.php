@extends('admin.layouts')

@section('content')
<section class="content-header bg-white mb-4 shadow">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Order #{{ $order->id }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.index') }}">Orders</a>
                    </li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">

            <h3 class="card-title text-bold">
                Order #{{ $order->id }} details.
                <br>
                <span class="text-muted">
                    Paid on
                    {{ $order->created_at->monthName }}
                    {{ $order->created_at->day }},
                    {{ $order->created_at->year }} @
                    {{ date("h:i A", strtotime($order->created_at)) }}
                </span>
            </h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">

            <div class="row mt-2">
                <div class="col-lg-4">
                    <h2>General</h2>
                    <label for="name" class="text-muted">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="Declined">Declined</option>
                        <option value="shipped">Shipped</option>
                    </select>
                    <table class="table bg-info mt-2">
                        <tbody>
                            <tr>
                                <td scope="row">Sub Total</i></td>
                                <td>${{ $order->billing_subtotal}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Tax</td>
                                <td>${{ $order->billing_tax}}</td>
                            </tr>
                            <tr>
                                <td scope="row">Total</td>
                                <td>${{ $order->billing_total}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="col-lg-4">
                    <h2>Billing</h2>
                    {{$order->billing_name }} <br>
                    {{ $order->billing_address}} <br>
                    <h4 class="mt-2">Email Address</h4>
                    {{ $order->billing_email }} <br>
                    Phone: {{ $order->billing_phone }}
                </div>
                <div class="col-lg-4">
                    <h2>Shipping</h2>
                    @if(!$order->shipping_address)
                    <h4>
                        <span class="badge badge-info">Same as billing address</span>
                    </h4>
                    {{$order->billing_name }} <br>
                    {{ $order->billing_address}} <br>
                    <h4 class="mt-2">Email Address</h4>
                    {{ $order->billing_email }} <br>
                    Phone: {{ $order->billing_phone }}
                    @else

                    @endif
                    <h3>Customer note</h3>
                    <p>Please leave the package infront of my door near the white painting.</p>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">PDF Invoice Data</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <h1>Invoice</h1>
            <button class="btn btn-info">Generate Invoice</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-bold">Products: {{ $order->products->count() }} items.</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>${{ ($product->price)*($product->pivot->quantity)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- /.content -->
@endsection