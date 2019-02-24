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
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="well text-center">
                    <strong>Total: €{{ $oSales->sum('fPrice') }}</strong>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>

        @foreach ($oSales as $oSale)
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <strong>{{ \App\Product::where('id', $oSale->iProductId)->first()->sName }}</strong>
                        </div>
                        <div class="col-md-6 text-right">
                            <strong>{{ $oSale->fPrice }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="row" style="margin-top:25px;">
            <div class="col-md-2"></div>
            <div class="col-md-8 text-left">
                <button class="btn btn-block btn-outline btn-success" id="pay" value="{{ $oBill->id }}">Mark as paid</button>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>

    <script src="{{ asset('js/pos/pay.js') }}"></script>
@endsection