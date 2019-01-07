<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 5-1-2019
 * Time: 21:50
 */

namespace App\Http\Controllers\api\v1;

use App\BarTicket;

class BarController
{
    public function getTickets()
    {
        $oTickets = BarTicket::all();

        return $oTickets;
    }

    public function deleteTicket($id)
    {
        $oTicket = BarTicket::where('id', $id)->delete();
    }
}