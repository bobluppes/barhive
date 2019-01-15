@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            <a href="/inventory"><i class="fa fa-arrow-circle-left"></i></a>
                            Editing {{ $oProduct->sName }} in category {{$oCategory->sName}}
                        </h1>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('url' => 'inventory/product/' . $oProduct->id . '/edit')) !!}
                        {!! Form::token() !!}

                        <div class="form-group row">
                            {!! Form::label('name', 'Product name', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('name', $oProduct->sName, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('description', 'Description', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::textarea('description', $oProduct->sDescription, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('price', 'Price', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::text('price', $oProduct->fPrice, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('active', 'Active', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::checkbox('active', 'active', $oProduct->bActive, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('inventory', 'Inventory', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::number('inventory', $oInventory->iInventory, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('minimumInventory', 'Minimum Inventory', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::number('minimumInventory', $oInventory->iMinimumInventory, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('orderComment', 'Order Comment', array('class' => 'col-2 col-form-label')) !!}
                            <div class="col-10">
                                {!! Form::checkbox('orderComment', 'orderComment', $oProduct->bOrderComment, array('class' => 'form-control')) !!}
                            </div>
                        </div>

                        {!! Form::number('catId', $oCategory->id, array('hidden' => true)) !!}
                        {!! Form::number('productId', $oProduct->id, array('hidden' => true)) !!}

                        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection