<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Inventory;

class ProductController extends Controller
{
    public function add(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required',
            'catId' => 'int',
            'inventory' => 'int',
            'minimumInventory' => 'int',
        ]);

        $oProduct = new Product();
        $oProduct->sName = $validatedData['name'];
        $oProduct->sDescription = $validatedData['description'];
        $oProduct->fPrice = $validatedData['price'];
        $oProduct->iCategoryId = $validatedData['catId'];
        $oProduct->save();

        $oInventory = new Inventory();
        $oInventory->iProductId = $oProduct->id;
        $oInventory->iInventory = $validatedData['inventory'];
        $oInventory->iMinimumInventory = $validatedData['minimumInventory'];
        $oInventory->save();

        return redirect('/inventory');
    }

    public function delete($id)
    {
        $oProduct = Product::where('id', $id);
        $oProduct->delete();

        return redirect('/inventory');
    }
}
