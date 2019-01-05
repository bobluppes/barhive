<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;

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

    public function product($id)
    {

        $oCategory = ProductCategory::where('id', $id)->first();

        return view('inventory.addProduct', ['oCategory' => $oCategory]);
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

    public function kitchen()
    {
        return view('kitchen.overview');
    }
}
