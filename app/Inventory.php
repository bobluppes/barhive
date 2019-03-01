<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'iProductId',
        'iInventory',
        'iMinimumInventory',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product', 'iProductId');
    }
}
