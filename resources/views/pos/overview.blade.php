@extends('layouts.fullscreen')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <a href="/pos" class="no-decoration">
                    <div class="pos-header-back text-center">
                        <h2>Back</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            @foreach ($oCategories as $oCategory)
                <div class="col-md-4">
                    <a href="/pos/{{ $iTable }}/cat/{{ $oCategory->id }}/" class="no-decoration">
                        <div class="pos-category text-center">
                            <h2>{{ $oCategory->sName }}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="/pos/{{ $iTable }}/pay" class="no-decoration">
                    <div class="pos-header-exit text-center">
                        <h2>Pay Bill</h2>
                        <p>Table {{ $iTable }}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection