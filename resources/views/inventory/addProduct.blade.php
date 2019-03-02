{{-- Store category into session --}}
<? session(['cat' => $oCategory->id]); ?>

@extends('layouts.dashboard')

@section('title')
    <a href="/inventory"><i class="fa fa-arrow-circle-left"></i></a>
    New product for category {{$oCategory->sName}}
@endsection

@section('content')
    <div class="row">

        {!! Form::open(array('url' => 'inventory/product', 'id' => 'editForm')) !!}
        {!! Form::token() !!}

        <div class="col-md-8">
            <div class="container-fluid">
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
                    {!! Form::label('price', 'Price (incl. VAT)', array('class' => 'col-2 col-form-label')) !!}
                    <div class="col-10">
                        {!! Form::text('price', '', array('class' => 'form-control')) !!}
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
                    {!! Form::checkbox('active', 'active', true, array('class' => '')) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('orderComment', 'Order Comment', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::checkbox('orderComment', 'orderComment', false, array('class' => '')) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('inventory', 'Inventory', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::number('inventory', 0, array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 text-left">
                    {!! Form::label('minimumInventory', 'Minimum Inventory', array('class' => 'col-2 col-form-label')) !!}
                </div>
                <div class="col-sm-6 text-left">
                    {!! Form::number('minimumInventory', 0, array('class' => 'form-control')) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            {!! Form::number('catId', $oCategory->id, array('hidden' => true)) !!}
            {!! Form::number('next', 0, array('hidden' => true)) !!}

            <div class="row">
                <div class="col-md-8">
                    {!! Form::submit('Save', array('class' => 'btn btn-block btn-primary')) !!}
                </div>
                <div class="col-md-4">
                    <button class="btn btn-block btn-warning" onclick="saveNext(event);">Save and Next</button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        window.onload = function() {
            saveNext = function(e) {
                e.preventDefault();

                var form = $('#editForm');
                var next = document.getElementsByName('next')[0];
                next.value = 1;
                form.submit();
            }
        }
    </script>
@endsection