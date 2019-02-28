{{-- Store category into session --}}
<? session(['cat' => $oCategory->id]); ?>

@extends('layouts.dashboard')

@section('title')
    <a href="/inventory"><i class="fa fa-arrow-circle-left"></i></a>
    New Category
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(array('url' => 'inventory/category/' . $oCategory->id . '/edit')) !!}
                        {!! Form::token() !!}

                        <div class="form-group row">
                            {!! Form::label('name', 'Category name', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('name', $oCategory->sName, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('makeOrder', 'Make Order', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::radio('makeOrder', 'none', ($oCategory->sMakeOrder == 'none') ? true : false) !!} None<br>
                                {!! Form::radio('makeOrder', 'Bar', ($oCategory->sMakeOrder == 'Bar') ? true : false) !!} Bar<br>
                                {!! Form::radio('makeOrder', 'Kitchen', ($oCategory->sMakeOrder == 'Kitchen') ? true : false) !!} Kitchen<br>
                            </div>
                        </div>

                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection