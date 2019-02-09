@extends('layouts.dashboard')

@section('title')
    Sales Analytics
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> <span id="morris-area-chart-title">Todays sales</span>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" id="morris-area-chart-action">
                                Today
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li><a href="#" onclick="areaVue.timeframeDay(event);">Today</a>
                                </li>
                                <li><a href="#" onclick="areaVue.timeframeMonth(event);">This month</a>
                                </li>
                                <li><a href="#" onclick="areaVue.timeframeYear(event);">This year</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="morris-area-chart"></div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>

        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Sales log
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Product</strong>
                        </div>
                        <div class="col-md-4">
                            <strong>Price</strong>
                        </div>
                        <div class="col-md-4">
                            <strong>Timestamp</strong>
                        </div>
                    </div>
                    @foreach ($oSales as $oSale)
                        <div class="row">
                            <div class="col-md-4">
                                @if (\App\Product::where('id', $oSale->iProductId)->get()->count() == 1)
                                    {{ \App\Product::where('id', $oSale->iProductId)->first()->sName }}
                                @else
                                    <i>Removed Item</i>
                                @endif
                            </div>
                            <div class="col-md-4">
                                {{ $oSale->fPrice }}
                            </div>
                            <div class="col-md-4">
                                {{ $oSale->created_at }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/vue.min.js') }}"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script src="{{ asset('js/analytics/sales.js') }}"></script>
@endsection