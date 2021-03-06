<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Inventory;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function add(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required',
            'catId' => 'required|int',
            'inventory' => 'int',
            'minimumInventory' => 'int',
            'next' => 'int',
        ]);

        $oProduct = new Product();
        $oProduct->sName = $validatedData['name'];
        $oProduct->sDescription = $validatedData['description'];
        $oProduct->fPrice = $validatedData['price'];
        $oProduct->iCategoryId = $validatedData['catId'];
        $oProduct->bActive = (bool) $oRequest->active;
        $oProduct->bOrderComment = (bool) $oRequest->orderComment;
        $oProduct->save();

        $oInventory = new Inventory();
        $oInventory->iProductId = $oProduct->id;
        $oInventory->iInventory = $validatedData['inventory'];
        $oInventory->iMinimumInventory = $validatedData['minimumInventory'];
        $oInventory->save();

        DB::table('product_sales_count')->insert([
            'iProductId' => $oProduct->id,
            'count' => 0,
        ]);

        if ($validatedData['next'] == 1) {
            return redirect('/inventory/category/' . $oProduct->iCategoryId . '/product');
        } else {
            return redirect('/inventory');
        }
    }

    public function delete($id)
    {
        $oProduct = Product::where('id', $id);
        $oInventory = Inventory::where('iProductId', $id);
        $oProduct->delete();
        $oInventory->delete();

        return redirect('/inventory');
    }

    public function update(Request $oRequest) {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required',
            'catId' => 'required|int',
            'productId' => 'required|int',
            'inventory' => 'int',
            'minimumInventory' => 'int',
        ]);

        $oProduct = Product::where('id', $validatedData['productId'])->first();
        $oProduct->sName = $validatedData['name'];
        $oProduct->sDescription = $validatedData['description'];
        $oProduct->fPrice = $validatedData['price'];
        $oProduct->iCategoryId = $validatedData['catId'];
        $oProduct->bActive = (bool) $oRequest->active;
        $oProduct->bOrderComment = (bool) $oRequest->orderComment;
        $oProduct->save();

        $oInventory = Inventory::where('iProductId', $validatedData['productId'])->first();
        $oInventory->iInventory = $validatedData['inventory'];
        $oInventory->iMinimumInventory = $validatedData['minimumInventory'];
        $oInventory->save();

        flash('Product ' . $oProduct->sName . ' saved')->success();
        return redirect('/inventory');
    }
}
