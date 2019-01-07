<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\ProductCategory;
use App\KitchenTicket;
use App\BarTicket;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function order(Request $oRequest)
    {
        $id = $oRequest->id;
        $orderComment = (string) $oRequest->orderComment;

        $oInventory = Inventory::where('iProductId', $id)->first();
        $oInventory->iInventory--;
        $oInventory->save();

        $oProduct = Product::where('id', $id)->first();
        $oCategory = ProductCategory::where('id', $oProduct->iCategoryId)->first();

        if ($oCategory->sMakeOrder != 'none') {
            if ($oCategory->sMakeOrder == 'Kitchen') {
                $oTicket = new KitchenTicket();
            } elseif ($oCategory->sMakeOrder == 'Bar') {
                $oTicket = new BarTicket();
            }
            $oTicket->sName = $oProduct->sName;
            $oTicket->sComment = $orderComment;
            $oTicket->save();
        }

        flash('Ordered ' . $oProduct->sName)->success();

        return redirect('/pos/' . $oProduct->iCategoryId);
    }
}
