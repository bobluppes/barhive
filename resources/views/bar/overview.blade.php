@extends('layouts.dashboard')

@section('title')
    Bar Tickets
@endsection

@section('content')
    <div id="app" class="container">

    </div>

    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script src="{{ asset('js/BarOrders.js') }}"></script>
@endsection