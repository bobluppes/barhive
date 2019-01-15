@extends('layouts.dashboard')

@section('title')
    Inventory Management
@endsection

@section('content')
    <div class="panel-body">
        <div class="panel-group" id="accordion">

            @foreach ($oCategories as $oCategory)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $oCategory->id }}">{{ $oCategory->sName }} (<strong>{{ count($oProducts->where('iCategoryId', $oCategory->id)) }}</strong>)</a>
                        </h4>
                    </div>
                    <div id="collapse{{ $oCategory->id }}" class="panel-collapse collapse">
                        @foreach ($oProducts->where('iCategoryId', $oCategory->id) as $oProduct)
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <strong>{{ $oProduct->sName }}</strong>
                                    </div>
                                    <div class="col-md-1">
                                        <i class="fa fa-euro"></i>
                                        {{ $oProduct->fPrice }}
                                    </div>
                                    <div class="col-md-1">
                                        <i class="fa fa-dropbox"></i>
                                        {{ $oProduct->getInventory() }}
                                    </div>
                                    <div class="col-md-1">
                                        <i class="fa fa-level-down"></i>
                                        {{ $oProduct->getMinimumInventory() }}
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="/inventory/product/{{$oProduct->id}}/edit"><i class="fa fa-edit text-primary"></i></a>
                                        <a href="/inventory/product/{{$oProduct->id}}/delete"><i class="fa fa-minus-circle text-danger"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/inventory/category/{{$oCategory->id}}/product"><button class="btn btn-success">Add product</button></a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="/inventory/category/{{$oCategory->id}}/delete"><button class="btn btn-danger">Delete category</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="panel-body">
        <div class="panel-group">
            <div class="well">
                <a href="/inventory/category"><button class="btn btn-primary">Add Category</button></a>
            </div>
        </div>
    </div>
@endsection