<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 5-1-2019
 * Time: 21:50
 */

namespace App\Http\Controllers\api\v1;

use App\Ticket;

class TicketController
{
    public function getTickets()
    {
        $oTickets = Ticket::all();

        return $oTickets;
    }

    public function getBarTickets() {
        return Ticket::all()->where('sDepartment', 'Bar');
    }

    public function getKitchenTickets() {
        return Ticket::all()->where('sDepartment', 'Kitchen');
    }

    public function deleteTicket($id)
    {
        $oTicket = Ticket::where('id', $id)->delete();
    }

    public function deleteAll()
    {
        Ticket::getQuery()->delete();
    }

    public function deleteAllKitchen()
    {
        Ticket::where('sDepartment', 'Kitchen')->delete();
    }

    public function deleteAllBar()
    {
        Ticket::where('sDepartment', 'Bar')->delete();
    }
}