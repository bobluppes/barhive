{{-- Store category into session --}}
<? session(['cat' => $oCategory->id]); ?>

@extends('layouts.dashboard')

@section('title')
    <a href="/inventory"><i class="fa fa-arrow-circle-left"></i></a>
    New product for category {{$oCategory->sName}}
@endsection

@section('content')
    <div class="row">

        {!! Form::open(array('url' => 'inventory/product/' . $oProduct->id . '/edit')) !!}
        {!! Form::token() !!}

        <div class="col-md-8">
            <div class="container-fluid">
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
                    {!! Form::label('price', 'Price (incl. VAT)', array('class' => 'col-2 col-form-label')) !!}
                    <div class="col-10">
                        {!! Form::text('price', $oProduct->fPrice, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('active', 'Active', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::checkbox('active', 'active', ($oProduct->bActive == 1) ? true : false, array('class' => '')) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('orderComment', 'Order Comment', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::checkbox('orderComment', 'orderComment', ($oProduct->bOrderComment == 1) ? true : false, array('class' => '')) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('inventory', 'Inventory', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::number('inventory', $oInventory->iInventory, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('minimumInventory', 'Minimum Inventory', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::number('minimumInventory', $oInventory->iMinimumInventory, array('class' => 'form-control')) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! Form::number('catId', $oCategory->id, array('hidden' => true)) !!}
            {!! Form::number('productId', $oProduct->id, array('hidden' => true)) !!}

            {!! Form::submit('Save', array('class' => 'btn btn-block btn-outline btn-primary')) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('contentold')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>

                        </h1>
                    </div>
                    <div class="card-body">




                        <input type="button" data-toggle="collapse" data-target="#extraOptions" value="Extra options" class="btn btn-secondary form-group form-control">

                        <div id="extraOptions" class="collapse">

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection