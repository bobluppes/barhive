@extends('layouts.dashboard')

@section('title')
    Inventory Management
@endsection

@section('contenttest')
    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>Rendering engine</th>
            <th>Browser</th>
            <th>Platform(s)</th>
            <th>Engine version</th>
            <th>CSS grade</th>
        </tr>
        </thead>
        <tbody>
        <tr class="odd gradeX">
            <td>Trident</td>
            <td>Internet Explorer 4.0</td>
            <td>Win 95+</td>
            <td class="center">4</td>
            <td class="center">X</td>
        </tr>
        <tr class="even gradeC">
            <td>Trident</td>
            <td>Internet Explorer 5.0</td>
            <td>Win 95+</td>
            <td class="center">5</td>
            <td class="center">C</td>
        </tr>
        <tr class="odd gradeA">
            <td>Trident</td>
            <td>Internet Explorer 5.5</td>
            <td>Win 95+</td>
            <td class="center">5.5</td>
            <td class="center">A</td>
        </tr>
        <tr class="even gradeA">
            <td>Trident</td>
            <td>Internet Explorer 6</td>
            <td>Win 98+</td>
            <td class="center">6</td>
            <td class="center">A</td>
        </tr>
        </tbody>
    </table>

    <button class="btn btn-success" onclick="addTableRow();">Add</button>
@endsection

@section('content')
    <div class="panel-body">
        <div class="panel-group" id="accordion">

            @foreach ($oCategories as $oCategory)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $oCategory->id }}">{{ $oCategory->sName }} (<strong>{{ count($oProducts->where('iCategoryId', $oCategory->id)) }}</strong>)</a>
                            @if ($oCategory->hasProductBelowMinimum())
                                    <i class="fa fa-warning text-danger"></i>
                            @endif
                        </h4>
                    </div>
                    <div id="collapse{{ $oCategory->id }}" class="panel-collapse collapse">

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Current Inventory</th>
                                    <th>Minimum Inventory</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($oProducts->where('iCategoryId', $oCategory->id) as $i=>$oProduct)

                                    <tr class="{{ (($i % 2) == 0) ? 'even' : 'odd' }} {{ ($oProduct->getInventory() < $oProduct->getMinimumInventory()) ? 'bg-danger' : '' }}">
                                        <td>{{ $oProduct->sName }}</td>
                                        <td><i class="fa fa-euro"></i> {{ $oProduct->fPrice }}</td>
                                        <td>{{ $oProduct->getInventory() }}</td>
                                        <td>{{ $oProduct->getMinimumInventory() }}</td>
                                        <td>
                                            <a href="/inventory/product/{{$oProduct->id}}/edit"><i class="fa fa-edit text-primary"></i></a>
                                            <a href="/inventory/product/{{$oProduct->id}}/delete"><i class="fa fa-minus-circle text-danger"></i></a>
                                        </td>
                                    </tr>

                                @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="/inventory/category/{{$oCategory->id}}/product"><button class="btn btn-success">Add product</button></a>
                                    {{--<button class="btn btn-success" id="addRow" onclick="addTableRow();">Add product</button>--}}
                                    {{--<button class="btn btn-primary" id="saveButton" onclick="saveRow();" style="display: none;">Save</button>--}}
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="/inventory/category/{{$oCategory->id}}/edit"><button class="btn btn-warning">Edit category</button></a>
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

@section('scripts')
    <!-- DataTables JavaScript -->
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap.js') }}"></script>
    {{--<script src="{{ asset('js/rowReorder.min.js') }}"></script>--}}
    <script src="{{ asset('js/dataTables.responsive.js') }}"></script>

    <script src="{{ asset('js/productTables.js') }}"></script>
@endsection