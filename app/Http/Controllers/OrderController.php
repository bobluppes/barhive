<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\KitchenTicket;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function order($id)
    {
        $oInventory = Inventory::where('iProductId', $id)->first();
        $oInventory->iInventory--;
        $oInventory->save();

        $oProduct = Product::where('id', $id)->first();

        $oTicket = new KitchenTicket();
        $oTicket->sName = $oProduct->sName;
        $oTicket->sComment = '';
        $oTicket->save();

        $oProduct = Product::where('id', $id)->first();

        return redirect('/pos/' . $oProduct->iCategoryId);
    }
}
