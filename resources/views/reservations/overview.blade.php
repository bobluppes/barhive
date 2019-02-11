@extends('layouts.dashboard')

@section('title')
    Reservations
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" data-toggle="modal" data-target="#newReservation">New Reservation</button>
        </div>
    </div>

    @include('modals.NewReservationPopup')

    <iframe src="https://calendar.google.com/calendar/embed?src=rgbcffg4n6nigibk3g9k73kfu0%40group.calendar.google.com&ctz=Europe%2FAmsterdam" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
@endsection