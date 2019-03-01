<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Sales;
use Illuminate\Http\Request;
use App\Inventory;
use App\Product;
use App\ProductCategory;
use App\Ticket;
use Illuminate\Support\Facades\DB;
use App\Table;

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

        $oProduct = Product::where('id', $id)->first();
        $oCategory = ProductCategory::where('id', $oProduct->iCategoryId)->first();

        // Check if product has enough inventory
        $oInventory = Inventory::where('iProductId', $id)->first();
        if ($oInventory->iInventory <= 0) {
            flash($oProduct->sName . ' out of stock')->error();
            return redirect('/pos/' . $iTable . '/cat/' . $oProduct->iCategoryId);
        }
        $oInventory->iInventory--;
        $oInventory->save();

        // Change table status if needed
        $oTable = Table::where('iTableId', $iTable)->first();
        $status = $oTable->sCurrentStatus;
        if ($status == 'empty') {
            $oTable->sCurrentStatus = 'seated';
            $oTable->save();

            $oBill = new Bill();
            $oBill->iTableId = $iTable;
            $oBill->iStatus = 0;
            $oBill->save();
        } else {
            $oBill = Bill::where('iTableId', $iTable)->where('iStatus', 0)->first();
        }

        $oSale = new Sales();
        $oSale->iProductId = $oProduct->id;
        $oSale->fPrice = $oProduct->fPrice;
        $oSale->iTable = $iTable;
        $oSale->iBillId = $oBill->id;
        $oSale->save();

        if ($oCategory->sMakeOrder != 'none') {
            $oTicket = new Ticket();
            $oTicket->iTable = $iTable;
            $oTicket->iSaleId = $oSale->id;
            $oTicket->sName = $oProduct->sName;
            $oTicket->sComment = $orderComment;
            $oTicket->sDepartment = $oCategory->sMakeOrder;
            $oTicket->save();
        }

        DB::table('product_sales_count')->where('iProductId', $id)->increment('count');

        flash('Ordered ' . $oProduct->sName . "<a style='cursor: pointer;'><span class='pull-right' onclick='undoSale(" . $oSale->id . ");'>undo</span></a>")->success();

        // Return to cat select is category is now empty
        $oCat = ProductCategory::where('id', $oCategory->id)->whereHas('products')->whereHas('products', function($query) {
            $query->where('bActive', 1)->whereHas('inventory', function($query) {
                $query->where('iInventory', '>', 0);
            });
        })->where('bActive', 1);
        if ($oCat->count() == 0) {
            return redirect('/pos/' . $iTable);
        }

        return redirect('/pos/' . $iTable . '/cat/' . $oProduct->iCategoryId);
    }
}
