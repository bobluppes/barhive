@extends('layouts.dashboard')

@section('title')
    Product Analytics
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel-success">
                <div class="panel-header">

                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/analytics/products.blade.php') }}"></script>
@endsection