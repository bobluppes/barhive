<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Bill;

class Table extends Model
{
    protected $fillable = [
        'iTableId', 'sCurrentStatus', 'iSaved',
    ];

    public function hasOpenBill()
    {
        $bill = Bill::where('iTableId', $this->iTableId)->where('iStatus', 0)->count();

        if ($bill > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getBill()
    {
        $oBill = Bill::where('iTableId', $this->iTableId)->where('iStatus', 0)->first();
        return $oBill;
    }
}
