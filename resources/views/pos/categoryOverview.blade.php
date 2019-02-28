@extends('layouts.fullscreen')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <a href="/pos/{{ $iTable }}" class="no-decoration">
                    <div class="pos-header-back text-center">
                        <h2>Back</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="container">
                @foreach ($oProducts as $oProduct)
                    @if ($bQuickOrder == 0)
                        <a href="/pos/{{ $iTable }}/cat/{{ $oProduct->iCategoryId }}/prod/{{ $oProduct->id }}" class="no-decoration">
                    @else
                        {!! Form::open(array('url' => 'pos/product', 'id' => 'form' . $oProduct->id)) !!}
                        {!! Form::token() !!}

                        {!! Form::hidden('id', $oProduct->id) !!}
                        {!! Form::hidden('table', $iTable) !!}
                        {!! Form::hidden('orderComment', '', array('class' => 'form-control')) !!}
                        <a onclick="$('#form{{ $oProduct->id }}').submit();" class="no-decoration">
                    @endif
                        <div class="col-sm-4 pos-category">
                            <div class="text-center">
                                <h2 style="font-size: calc(15px + 0.9vw);">{{ $oProduct->sName }}</h2>
                            </div>
                        </div>
                    </a>
                    @if ($bQuickOrder != 0)
                        {!! Form::close() !!}
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection