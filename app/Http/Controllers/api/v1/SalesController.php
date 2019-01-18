<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 5-1-2019
 * Time: 21:50
 */

namespace App\Http\Controllers\api\v1;

use App\Sales;

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
            $data[$j]->time = (string) $i;
            $j++;
        }

        return json_encode($data);
    }

    public function getAll()
    {
        $oSales = Sales::all();

        $data = [];
        foreach ($oSales as $i=>$oSale) {
            $data[$i] = new \stdClass();
            $data[$i]->revenue = $oSale->fPrice;
            $data[$i]->time = $oSale->created_at->format('M:d:Y:H:i:s');
        }

        return json_encode($data);
    }
}