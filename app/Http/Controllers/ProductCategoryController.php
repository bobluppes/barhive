<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;

class ProductCategoryController extends Controller
{
    public function add(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'makeOrder'=> 'required|string|max:255',
        ]);

        $oCategory = new ProductCategory;
        $oCategory->sName = $validatedData['name'];
        $oCategory->sMakeOrder = $validatedData['makeOrder'];
        $oCategory->save();

        return redirect('/inventory');
    }

    public function edit(Request $oRequest, $id)
    {
        $validatedData = $oRequest->validate([
            'name' => 'required|string|max:255',
            'makeOrder'=> 'required|string|max:255',
        ]);

        $oCategory = ProductCategory::where('id', $id)->first();
        $oCategory->sName = $validatedData['name'];
        $oCategory->sMakeOrder = $validatedData['makeOrder'];
        $oCategory->save();

        return redirect('/inventory');
    }

    public function delete($id)
    {
        $oCategory = ProductCategory::where('id', $id);
        $oCategory->delete();

        return redirect('/inventory');
    }
}
