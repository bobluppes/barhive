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

    public function getMinimumInventory()
    {
        $oInventory = Inventory::where('iProductId', $this->id)->first();

        return $oInventory->iMinimumInventory;
    }
}
