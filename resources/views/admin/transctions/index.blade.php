@extends('admin.layouts')

@section('content')
<section class="content-header bg-white mb-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Transctions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="#">Transctions</a>
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
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Amount</th>
                                <th>Currency</th>
                                <th>Card Type</th>
                                <th>Last Four</th>
                                <th>Charge Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($charges as $charge)
                            <tr>
                                <td>
                                    {{ $charge['id'] }}
                                </td>
                                <td class="bg-navy">
                                    ${{ $charge['amount']/100 }}
                                </td>
                                <td>
                                    {{ $charge['currency'] }}
                                </td>

                                <td>
                                    {{ $charge['source']['brand'] }}
                                </td>
                                <td>
                                    {{ $charge['source']['last4'] }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($charge['created'])->diffForhumans() }},
                                    {{ \Carbon\Carbon::parse($charge['created'])->setTimezone('UTC') }}
                                </td>
                                <td class="btn-group">
                                    <a href={{ route('admin.stripe.transctions.show', ['id' => $charge['id']]) }} class="btn btn-sm btn-info">
                                        View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>

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