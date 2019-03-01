<?php
/**
 * Created by PhpStorm.
 * User: boblu
 * Date: 01/03/2019
 * Time: 22:28
 */

namespace App\Http\Controllers\api\v1;

use App\Product;
use Illuminate\Support\Facades\DB;

class ProductController
{
    public function getSales()
    {
        $oProducts = Product::all();

        $sales = [];
        $i = 0;
        foreach($oProducts as $oProduct) {
            if (DB::table('product_sales_count')->where('iProductId', $oProduct->id)->first()->count != 0) {
                $sales[$i] = new \stdClass();
                $sales[$i]->label = $oProduct->sName;
                $sales[$i]->value = DB::table('product_sales_count')->where('iProductId', $oProduct->id)->first()->count;
                $i++;
            }
        }

        return $sales;
    }
}