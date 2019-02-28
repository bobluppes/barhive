<?php
/**
 * Created by PhpStorm.
 * User: boblu
 * Date: 24/02/2019
 * Time: 21:11
 */

namespace App\Http\Controllers\api\v1;


use App\Bill;
use App\Table;
use App\Inventory;
use Illuminate\Support\Facades\DB;

class BillController
{
    public function pay($id)
    {
        $oBill = Bill::where('id', $id)->first();
        $oBill->iStatus = 1;
        $oBill->save();

        $oTable = Table::where('iTableId', $oBill->iTableId)->first();
        $oTable->sCurrentStatus = 'empty';
        $oTable->save();
    }

    public function delete($id)
    {
        // Delete all sales associated
        $oBill = Bill::where('id', $id)->first();
        $oSales = $oBill->sales;
        foreach ($oSales as $oSale) {
            // Decrease sales counter
            DB::table('product_sales_count')->where('iProductId', $oSale->iProductId)->decrement('count');
            // Increase inventory
            $oInventory = Inventory::where('iProductId', $oSale->iProductId)->first();
            $oInventory->iInventory++;
            $oInventory->save();
            // Delete sale
            $oSale->delete();
        }

        // Free the table
        $oTable = $oBill->table;
        $oTable->sCurrentStatus = 'empty';
        $oTable->save();

        // Delete the bill
        $oBill->delete();
    }
}