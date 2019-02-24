<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sales;

class Bill extends Model
{
    public function getSales()
    {
        $oSales = Sales::where('iBillId', $this->id)->get();
        return $oSales;
    }
}
