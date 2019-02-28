@extends('layouts.fullscreen')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <a href="/pos/{{ $oTable->iTableId }}" class="no-decoration">
                    <div class="pos-header-back text-center">
                        <h2>Back</h2>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="well text-center">
                    <strong>Total: {{ \App\Setting::where('setting', 'curr')->first()->getSymbol() . $oSales->sum('fPrice') }}</strong>
                    <span class="pull-right">
                        <i id="deleteBill" data-id="{{ $oBill->id }}" class="fa fa-minus-circle text-danger" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        @foreach ($oSales as $oSale)
            <div class="row" id="saleRow-{{ $oSale->id }}">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <span class="pull-left">
                                <i name="deleteSale" data-id="{{ $oSale->id }}" class="fa fa-minus-circle text-danger" style="cursor: pointer;"></i>&nbsp
                            </span>
                            <strong>{{ \App\Product::where('id', $oSale->iProductId)->first()->sName }}</strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <strong>{{ $oSale->fPrice }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row" style="margin-top: 25px;">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="container">
                    <div class="row">
                        Total excl. tax:
                    </div>
                    <div class="row">
                        Tax high:
                    </div>
                    <div class="row">
                        Tax low:
                    </div>
                    <div class="row">
                        &nbsp
                    </div>
                    <div class="row">
                        Total:
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row" style="margin-top:25px;">
            <div class="col-md-3"></div>
            <div class="col-md-6 text-left">
                <button class="btn btn-block btn-outline btn-primary">Email bill</button>
                <button class="btn btn-block btn-success" id="pay" value="{{ $oBill->id }}">Mark as paid</button>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>

    <script src="{{ asset('js/pos/pay.js') }}"></script>
@endsection