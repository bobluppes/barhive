{{-- Store category into session --}}
<? session(['bNewCat' => true]); ?>

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
                        {!! Form::open(array('url' => 'inventory/category')) !!}
                        {!! Form::token() !!}

                        <div class="form-group row">
                            {!! Form::label('name', 'Category name', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('name', '', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('makeOrder', 'Make Order', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::radio('makeOrder', 'none', true) !!} None<br>
                                {!! Form::radio('makeOrder', 'Bar', false) !!} Bar<br>
                                {!! Form::radio('makeOrder', 'Kitchen', false) !!} Kitchen<br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('active', 'Active', array('class' => 'col-2 col-form-label')) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::checkbox('active', 'active', true, array('class' => '')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection