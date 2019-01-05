<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class KitchenController extends Controller
{

    public function getTickets()
    {
        $oProducts = Product::all();

        return $oProducts;
    }
}
