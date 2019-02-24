<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function create(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'people' => 'required|int',
            'start' => 'required',
            'end' => 'required',
        ]);

        // Create a new event and save to google
        $event = new Event;
        $event->name = 'Reservation ' . $validatedData['name'];
        $event->startDateTime = Carbon::parse($validatedData['start']);
        $event->endDateTime = Carbon::parse($validatedData['end']);
        $event->addAttendee(['email' => env('COMPANY_EMAIL')]);
        $event->addAttendee(['email' => $validatedData['email']]);
        $event->save();

        // save event to local database
        $reservation = new Reservation();
        $reservation->name = $validatedData['name'];
        $reservation->email = $validatedData['email'];
        $reservation->people = $validatedData['people'];
        $reservation->table = 1;
        $reservation->start = Carbon::parse($validatedData['start']);
        $reservation->end = Carbon::parse($validatedData['end']);
        $reservation->save();

        return view('reservations.overview');
    }
}
