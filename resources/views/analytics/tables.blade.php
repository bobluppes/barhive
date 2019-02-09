@extends('layouts.dashboard')

@section('title')
    Table Analytics
@endsection

@section('content')
    <div id="container"></div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>

    <script src="{{ asset('js/analytics/tables.js') }}"></script>
@endsection