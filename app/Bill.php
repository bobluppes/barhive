<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sales;

class Bill extends Model
{
    public function sales()
    {
        return $this->hasMany('App\Sales', 'iBillId');
    }

    public function table()
    {
        return $this->belongsTo('App\Table', 'iTableId', 'iTableId');
    }
}
