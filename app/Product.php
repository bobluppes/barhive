<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Inventory;

class Product extends Model
{
    protected $fillable = [
        'sName',
        'sDescription',
        'fPrice',
        'iCategoryId',
        'bActive',
    ];

    public function getInventory()
    {
        $oInventory = Inventory::where('iProductId', $this->id)->first();

        return $oInventory->iInventory;
    }

    public function inventory()
    {
        return $this->hasOne('App\Inventory', 'iProductId');
    }

    public function category()
    {
        return $this->belongsTo('App\ProductCategory', 'iCategoryId');
    }

    public function getMinimumInventory()
    {
        $oInventory = Inventory::where('iProductId', $this->id)->first();

        return $oInventory->iMinimumInventory;
    }
}
