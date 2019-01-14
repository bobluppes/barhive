@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    You are logged in as {{Auth::user()->name}}
@endsection
