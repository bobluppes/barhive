@extends('layouts.dashboard')

@section('title')
    <div class="row">
        <div class="col-md-9">
            Tickets
        </div>
        <div class="col-md-3 text-right">
            <button class="btn btn-danger" onclick="allOrder.deleteAll();">Delete All</button>
        </div>
    </div>
@endsection

@section('content')
    <div id="app" class="container">

    </div>

    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script src="{{ asset('js/AllOrders.js') }}"></script>
@endsection