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

        //create a new event
        $event = new Event;

        $event->name = 'Reservation ' . $validatedData['name'];
        $event->startDateTime = Carbon::now();
        $event->endDateTime = Carbon::now()->addHour();
        $event->addAttendee(['email' => env('COMPANY_EMAIL')]);
        $event->addAttendee(['email' => $validatedData['email']]);

        $event->save();

        return view('reservations.overview');
    }
}
