<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Sales extends Model
{
    protected $fillable = [
        'iProductId',
        'fPrice',
    ];

    public function getProduct() {
        $oProduct = Product::where('id', this.iProductId)->first();

        return $oProduct;
    }
}
