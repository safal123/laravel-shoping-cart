@extends('admin.layouts')

@section('content')
<section class="content-header bg-white mb-4 shadow">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Orders</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.orders.index') }}">Orders</a>
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
                <div class="card-header border-transparent">

                    <h3 class="card-title">All Orders</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i> -->
                        </button>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Billing Total</th>
                                    <th>Purchase Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->billing_name}}</td>
                                    <td>
                                        <span class="badge badge-danger">Pending</span>
                                        <button class="btn btn-sm btn-info" id="orderUpdateButton">Update</button>
                                    </td>
                                    <td>
                                        <div class="sparkbar" data-color="#00a65a" data-height="20">{{ $order->billing_email }}</div>
                                    </td>
                                    <td>(AUD) ${{ $order->billing_total }}</td>
                                    <td>
                                        {{ $order->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary btn-sm">View more</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <!-- <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                </div> -->
                <!-- /.card-footer -->
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="orderUpdateModel" tabindex="-1" role="dialog" aria-labelledby="orderUpdateModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderUpdateModelLabel">Update order status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <label for="name" class="text-muted">Status</label>
                    <select id="status" name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="Declined">Declined</option>
                    </select>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Update</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('extrajs')

<script type="text/javascript">
    $(document).ready(function() {
        $('#orderUpdateButton').click(function() {
            $('#orderUpdateModel').modal('show');
        })
    })
</script>

@endsection