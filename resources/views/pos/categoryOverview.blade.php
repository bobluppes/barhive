@extends('layouts.app')

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
            @foreach ($oProducts as $oProduct)
                <div class="col-md-4">
                    <a href="product/{{ $oProduct->id }}" class="no-decoration">
                        <div class="pos-category text-center">
                            <h2>{{ $oProduct->sName }}</h2>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection