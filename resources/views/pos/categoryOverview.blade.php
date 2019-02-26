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
            @foreach ($oProducts as $oProduct)
                <div class="col-md-4">
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
                        <div class="pos-category text-center">
                            <h2>{{ $oProduct->sName }}</h2>
                        </div>
                    </a>
                    @if ($bQuickOrder != 0)
                        {!! Form::close() !!}
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection