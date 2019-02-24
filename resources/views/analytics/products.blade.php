@extends('layouts.dashboard')

@section('title')
    Product Analytics
@endsection

@section('content')
    <div class="row">
        @foreach ($oTopProducts as $product)
            <div class="col-md-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        {{ $product->sName }}
                    </div>
                    <div class="panel-body">
                        Sold <strong>{{ $product->count }}</strong> times
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                </div>
                <div class="panel-body">
                    <div id="morris-donut-chart"></div>
                    <a href="#" class="btn btn-default btn-block">View Details</a>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/analytics/products.js') }}"></script>
@endsection