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
@endsection

@section('scripts')
    <script src="{{ asset('js/analytics/products.blade.php') }}"></script>
@endsection