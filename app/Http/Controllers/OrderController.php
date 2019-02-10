<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\ProductCategory;
use App\Ticket;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function order(Request $oRequest)
    {
        $id = $oRequest->id;
        $iTable = $oRequest->table;
        $orderComment = (string) $oRequest->orderComment;

        $oInventory = Inventory::where('iProductId', $id)->first();
        $oInventory->iInventory--;
        $oInventory->save();

        $oProduct = Product::where('id', $id)->first();
        $oCategory = ProductCategory::where('id', $oProduct->iCategoryId)->first();

        if ($oCategory->sMakeOrder != 'none') {
            $oTicket = new Ticket();
            $oTicket->iTable = $iTable;
            $oTicket->sName = $oProduct->sName;
            $oTicket->sComment = $orderComment;
            $oTicket->sDepartment = $oCategory->sMakeOrder;
            $oTicket->save();
        }

        $oSale = new Sales();
        $oSale->iProductId = $oProduct->id;
        $oSale->fPrice = $oProduct->fPrice;
        $oSale->iTable = $iTable;
        $oSale->save();

        DB::table('product_sales_count')->where('iProductId', $id)->increment('count');

        flash('Ordered ' . $oProduct->sName)->success();

        return redirect('/pos/' . $iTable . '/cat/' . $oProduct->iCategoryId);
    }
}
