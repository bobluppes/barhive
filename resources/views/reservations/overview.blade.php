@extends('layouts.dashboard')

@section('title')
    Reservations
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <button class="btn btn-primary" data-toggle="modal" data-target="#newReservation">New Reservation</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#calendar">Calendar</a></li>
                <li><a data-toggle="tab" href="#table">Table Reservations</a></li>
            </ul>
        </div>
    </div>

    <div class="tab-content">
        <div id="calendar" class="tab-pane fade in active">
            <div class="row">
                <div class="col-md-12">
                    <iframe src="https://calendar.google.com/calendar/embed?src=rgbcffg4n6nigibk3g9k73kfu0%40group.calendar.google.com&ctz=Europe%2FAmsterdam"
                            style="border: 0"
                            width="100%"
                            height="600"
                            frameborder="0"
                            scrolling="no">
                    </iframe>
                </div>
            </div>
        </div>
        <div id="table" class="tab-pane fade">
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="p-2">
                        <input type="date" value="{{ \Illuminate\Support\Carbon::now()->format('d-m-Y') }}"/>
                    </div>
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.NewReservationPopup')

@endsection

@section('scripts')
    <script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>

    <script src="{{ asset('js/reservations/tables.js') }}"></script>
@endsection