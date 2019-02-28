<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 5-1-2019
 * Time: 21:50
 */

namespace App\Http\Controllers\api\v1;

use App\Inventory;
use App\Sales;
use Illuminate\Support\Facades\DB;

class SalesController
{
    public function getToday()
    {
        $oSalesToday = Sales::all()->filter(function($date) {
            return $date->created_at->isToday();
        });

        $data = [];
        $j = 0;
        for ($i = 8; $i < 24; $i++) {
            $oSalesThisHour = $oSalesToday->filter(function($date) use($i){
                return $date->created_at->format('H') == $i;
            });
            $data[$j] = new \stdClass();
            $data[$j]->revenue = $oSalesThisHour->sum('fPrice');
            $data[$j]->time = date('Y-m-d') . ' ' . $i . ':00:00';
            $j++;
        }

        return json_encode($data);
    }

    public function getMonth()
    {
        $oSalesMonth = Sales::all()->filter(function($date) {
            return $date->created_at->format('m') == date('m');
        });

        $data = [];
        $j = 0;
        for ($i = 1; $i < (cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y')) + 1); $i++) {
            $oSalesThisDay = $oSalesMonth->filter(function($date) use ($i) {
                return $date->created_at->format('d') == $i;
            });
            $data[$j] = new \stdClass();
            $data[$j]->revenue = $oSalesThisDay->sum('fPrice');
            $data[$j]->time = date('Y-m') . '-' . $i;
            $j++;
        }

        return json_encode($data);

        return json_encode($data);
    }

    public function getYear()
    {
        $oSalesYear = Sales::all()->filter(function($date) {
            return $date->created_at->format('Y') == date('Y');
        });

        $data = [];
        $j = 0;
        for ($i = 1; $i < 13; $i++) {
            $oSalesThisMonth = $oSalesYear->filter(function($date) use ($i) {
                return $date->created_at->format('m') == $i;
            });
            $data[$j] = new \stdClass();
            $data[$j]->revenue = $oSalesThisMonth->sum('fPrice');
            $data[$j]->time = date('Y') . '-' . $i . '-00';
            $j++;
        }

        return json_encode($data);
    }

    public function getByTable($id)
    {
        $sales = Sales::where('iTable', $id)->sum('fPrice');
        return $sales;
    }

    public function delete($id)
    {
        $oSale = Sales::where('id', $id)->first();
        $iProductId = $oSale->iProductId;

        $oSale->ticket->delete();
        $oSale->delete();

        // Decrease sales counter
        DB::table('product_sales_count')->where('iProductId', $iProductId)->decrement('count');
        // Increment inventory
        $oInventory = Inventory::where('iProductId', $iProductId)->first();
        $oInventory->iInventory++;
        $oInventory->save();
    }
}