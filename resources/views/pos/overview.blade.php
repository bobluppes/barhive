@extends('layouts.dashboard')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <a href="/dashboard" class="no-decoration">
                    <div class="pos-header-exit text-center">
                        <h2>Exit POS Mode</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($oCategories as $oCategory)
                <div class="col-md-4">
                    <a href="/pos/{{ $oCategory->id }}/" class="no-decoration">
                        <div class="pos-category text-center">
                            <h2>{{ $oCategory->sName }}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection