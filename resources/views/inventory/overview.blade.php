@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>
                            <a href="/dashboard"><i class="fa fa-arrow-circle-left"></i></a>
                            Inventory Overview</h1>
                    </div>
                    <div class="card-body">
                        <h4>Categories</h4>

                        @foreach ($oCategories as $oCategory)
                            <div class="category" onclick="toggleCollapse(event, {{$oCategory->id}})">
                                <strong>{{ $oCategory->sName  }}</strong>
                                (<strong>{{ count($oProducts->where('iCategoryId', $oCategory->id)) }}</strong>)
                            </div>

                            <div id="category{{$oCategory->id}}" style="display:none;">
                                <div class="category-specification">

                                    @foreach ($oProducts->where('iCategoryId', $oCategory->id) as $oProduct)
                                        <div class="product">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>{{ $oProduct->sName }}</strong>
                                                </div>
                                                <div class="col-md-1">
                                                    <i class="fa fa-euro-sign"></i>
                                                    {{ $oProduct->fPrice }}
                                                </div>
                                                <div class="col-md-1">
                                                    <i class="fa fa-box"></i>
                                                    {{ $oProduct->getInventory() }}
                                                </div>
                                                <div class="col-md-1">
                                                    <i class="fa fa-level-down-alt"></i>
                                                    {{ $oProduct->getMinimumInventory() }}
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <a href="/inventory/product/{{$oProduct->id}}/delete"><i class="fa fa-minus-circle"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <a href="/inventory/category/{{$oCategory->id}}/product"><button class="btn btn-warning category-button">Add product</button></a>
                                    <a href="/inventory/category/{{$oCategory->id}}/delete"><button class="btn btn-danger category-button">Delete category</button></a>
                                </div>
                            </div>
                        @endforeach

                        <a href="/inventory/category"><button class="btn btn-primary category-button">Add Category</button></a>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Input delivery</button>
                        <button class="btn btn-primary">Edit stock</button>
                        <button class="btn btn-danger">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            toggleCollapse = function(e, cat) {
                e.preventDefault();

                let collapse = document.getElementById('category' + cat);

                if (collapse.style.display == 'none') {
                    collapse.style.display = 'block';
                } else {
                    collapse.style.display = 'none';
                }
            }
        }
    </script>
@endsection