<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class ProductCategory extends Model
{
    protected $fillable = [
        'sName',
        'sMakeOrder',
        'bActive',
    ];

    public function hasProductBelowMinimum()
    {
        $oProducts = Product::where('iCategoryId', $this->id)->get()->filter(function($product) {
            return ($product->getInventory() < $product->getMinimumInventory());
        });

        $result = $oProducts->count() > 0;
        return $result;
    }
}
