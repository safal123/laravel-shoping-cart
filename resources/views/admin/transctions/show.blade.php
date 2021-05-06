@extends('admin.layouts')

@section('content')
<section class="content-header bg-white mb-2">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <p class="text-navy">{{ $charge['id'] }}</p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.stripe.transctions') }}">Transctions</a>
                    </li>
                    <li class="breadcrumb-item active">View</li>
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
                    <div class="p-2 text-right">
                        @if(!$charge['amount_refunded'] > 0)
                        <form action="{{ route('admin.stripe.transctions.refund') }}" method="POST">
                            @csrf()
                            <input type="hidden" value="{{$charge['id']}}" name="charge">
                            <button type="submit" class="btn btn-primary">Refund ?</button>
                        </form>
                        @else
                        <div class="bg-success p-2 text-center">This transction is already refunded.</div>
                        @endif

                    </div>
                    <pre class="text-success" id="json-trans">{{ json_encode($charge, JSON_PRETTY_PRINT) }}</pre>
                    <!-- @foreach($charge as $key=>$value)
                    <div class="text-success d-flex justify-content-between">
                        <div>
                            {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $key)) }}
                        </div>
                        <div>
                            @if(is_array($value))
                            @foreach($value as $k=>$v)
                            {{ $k }} <br>
                            @if(is_array($v))
                            @foreach($v as $w=>$x)
                            {{ $w}} <br>
                            @endforeach
                            @else
                            {{$v}}
                            @endif
                            @endforeach
                            @else
                            {{ $value}}
                            @endif
                        </div>
                    </div>

                    <br>
                    @endforeach -->
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

@endsection