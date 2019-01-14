@extends('layouts.dashboard')

@section('title')
    Kitchen Tickets
@endsection

@section('content')
    <div id="app" class="container">

    </div>

    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script src="{{ asset('js/KitchenOrders.js') }}"></script>
@endsection