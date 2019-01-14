@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            <a href="/inventory"><i class="fa fa-arrow-circle-left"></i></a>
                            New product for category {{$oCategory->sName}}
                        </h1>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('url' => 'inventory/product')) !!}
                        {!! Form::token() !!}

                        <div class="form-group row">
                            {!! Form::label('name', 'Product name', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('name', '', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('description', 'Description', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::textarea('description', '', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('price', 'Price', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('price', '', array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <input type="button" data-toggle="collapse" data-target="#extraOptions" value="Extra options" class="btn btn-secondary form-group form-control">

                        <div id="extraOptions" class="collapse">
                            <div class="form-group row">
                                {!! Form::label('active', 'Active', array('class' => 'col-2 col-form-label')) !!}
                                <div class="col-10">
                                    {!! Form::checkbox('active', 'active', true, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('inventory', 'Inventory', array('class' => 'col-2 col-form-label')) !!}
                                <div class="col-10">
                                    {!! Form::number('inventory', 0, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('minimumInventory', 'Minimum Inventory', array('class' => 'col-2 col-form-label')) !!}
                                <div class="col-10">
                                    {!! Form::number('minimumInventory', 0, array('class' => 'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                {!! Form::label('orderComment', 'Order Comment', array('class' => 'col-2 col-form-label')) !!}
                                <div class="col-10">
                                    {!! Form::checkbox('orderComment', 'orderComment', false, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                        </div>

                        {!! Form::number('catId', $oCategory->id, array('hidden' => true)) !!}

                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection