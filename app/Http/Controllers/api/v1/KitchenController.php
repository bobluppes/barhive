<?php

namespace App\Http\Controllers\api\v1;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KitchenTicket;

class KitchenController extends Controller
{

    public function getTickets()
    {
        $oTickets = KitchenTicket::all();

        return $oTickets;
    }

    public function deleteTicket($id)
    {
        $oTicket = KitchenTicket::where('id', $id)->delete();

        return redirect('/kitchen');
    }
}
