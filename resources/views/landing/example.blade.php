@extends('landing.layouts.example')

@section('content')
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/dashboard') }}">BarHive Controlpanel</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            BarHive POS
        </div>

        <div class="links">
            <a href="https://bobluppes.github.io/barhive/">About</a>
        </div>
    </div>
@endsection