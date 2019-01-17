@extends('layouts.dashboard')

@section('title')
    Tickets
@endsection

@section('content')
    <div id="app" class="container">

    </div>

    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script src="{{ asset('js/AllOrders.js') }}"></script>
@endsection