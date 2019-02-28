@extends('layouts.fullscreen')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @if ($bDontOrderOnTable == 0)
                    <a href="/pos" class="no-decoration">
                        <div class="pos-header-back text-center">
                            <h2>Back</h2>
                        </div>
                    </a>
                @elseif ($oTable->hasOpenBill())
                    <div class="pos-header-disabled text-center">
                        <h2>Exit</h2>
                    </div>
                @else
                    <a href="/dashboard" class="no-decoration">
                        <div class="pos-header-exit text-center">
                            <h2>Exit</h2>
                        </div>
                    </a>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="container">
                @foreach ($oCategories as $oCategory)
                    <a href="/pos/{{ $oTable->iTableId }}/cat/{{ $oCategory->id }}/" class="no-decoration">
                        <div class="col-sm-4 pos-category">
                            <div class="text-center">
                                <h2 style="font-size: calc(15px + 0.9vw);">{{ $oCategory->sName }}</h2>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        @if ($oTable->hasOpenBill())
            <div class="row">
                <div class="col-md-12">
                    <a href="/pos/{{ $oTable->iTableId }}/pay" class="no-decoration">
                        <div class="pos-header-exit text-center">
                            <h2>Pay Bill</h2>
                            <p>Table {{ $oTable->iTableId }}</p>
                        </div>
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection