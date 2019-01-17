<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\ProductCategory;
use App\Ticket;

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
            $oTicket = new Ticket();
            $oTicket->sName = $oProduct->sName;
            $oTicket->sComment = $orderComment;
            $oTicket->sDepartment = $oCategory->sMakeOrder;
            $oTicket->save();
        }

        $oSale = new Sales();
        $oSale->iProductId = $oProduct->id;
        $oSale->fPrice = $oProduct->fPrice;
        $oSale->save();

        flash('Ordered ' . $oProduct->sName)->success();

        return redirect('/pos/' . $oProduct->iCategoryId);
    }
}
