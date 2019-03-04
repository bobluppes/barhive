@extends('layouts.dashboard')

@section('title')
    Management Settings
@endsection

@section('content')
    <div class="row">
        <div class="col-md-3">
            <strong>Currency </strong>
            <a data-toggle="popover"
               data-content="Select the currency to use in BarHive POS">
                <i class="fa fa-question-circle fa-fw"></i>
            </a>
        </div>
        <div class="col-md-3">
            <select onchange="saveSetting('curr', this.value);" autocomplete="off">
                <option value="0" {{ ($curr == 0) ? 'selected' : '' }}>Eur</option>
                <option value="1" {{ ($curr == 1) ? 'selected' : '' }}>USD</option>
                <option value="2" {{ ($curr == 2) ? 'selected' : '' }}>GBP</option>
            </select>
        </div>
    </div>

    Set user levels
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('[data-toggle="popover"]').popover();
        });
    </script>

    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>
    <script src="{{ asset('js/settings/management.js') }}"></script>
@endsection