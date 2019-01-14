@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            <a href="/inventory"><i class="fa fa-arrow-circle-left"></i></a>
                            New Category
                        </h1>
                    </div>
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

                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection