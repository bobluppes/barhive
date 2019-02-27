@extends('layouts.dashboard')

@section('title')
    POS Settings
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <strong>Don't order on table </strong>
            <a data-toggle="popover"
               data-content="When don't order on table is enabled, a POS order will not be saved to a table, nor do you have to select it when making a POS order">
                <i class="fa fa-question-circle fa-fw"></i>
            </a>
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="dontOrderOnTable" onchange="saveSetting('dontOrderOnTable', this.checked);"
                    {{ ($oSettings->where('setting', 'dontOrderOnTable')->first()->value) ? 'checked' : '' }}>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <strong>Quick order mode </strong>
            <a data-toggle="popover"
               data-content="When this option is enabled, the product overview in POS mode is disabled and selecting a product directly orders it">
                <i class="fa fa-question-circle fa-fw"></i>
            </a>
        </div>
        <div class="col-md-3">
            <input type="checkbox" name="quickOrder" onchange="saveSetting('quickOrder', this.checked);"
                    {{ ($oSettings->where('setting', 'quickOrder')->first()->value) ? 'checked' : '' }}>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>

    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script src="{{ asset('js/settings/pos.js') }}"></script>
@endsection