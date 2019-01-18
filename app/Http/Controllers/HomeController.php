<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
use App\Inventory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function inventory()
    {
        $oCategories = ProductCategory::all();
        $oProducts = Product::all();

        return view('inventory.overview', ['oCategories' => $oCategories, 'oProducts' => $oProducts]);
    }

    public function category()
    {
        return view('inventory.addCategory');
    }

    public function addProduct($id)
    {

        $oCategory = ProductCategory::where('id', $id)->first();

        return view('inventory.addProduct', ['oCategory' => $oCategory]);
    }

    public function editProduct($id)
    {
        $oProduct = Product::where('id', $id)->first();
        $oCategory = ProductCategory::where('id', $oProduct->iCategoryId)->first();
        $oInventory = Inventory::where('iProductId', $id)->first();

        return view('inventory.editProduct', ['oCategory' => $oCategory, 'oProduct' => $oProduct, 'oInventory' => $oInventory]);
    }

    public function pos()
    {
        $oCategories = ProductCategory::all();

        return view('pos.overview', ['oCategories' => $oCategories]);
    }

    public function posCategory($id)
    {
        $oProducts = Product::all()->where('iCategoryId', $id);

        return view('pos.categoryOverview', ['oProducts' => $oProducts]);
    }

    public function posProduct($id)
    {
        $oProduct = Product::all()->where('id', $id)->first();

        return view('pos.productOverview', ['oProduct' => $oProduct]);
    }

    public function tickets()
    {
        return view('tickets.all');
    }

    public function kitchen()
    {
        return view('tickets.kitchen');
    }

    public function bar()
    {
        return view('tickets.bar');
    }

    public function tableSettings()
    {
        return view('settings.table');
    }

    public function managementSettings()
    {

    }

    public function posSettings()
    {

    }

    public function userSettings()
    {

    }

    public function profile()
    {

    }
}
