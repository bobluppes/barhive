<?php

namespace App\Http\Controllers;

use App\Sales;
use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;
use App\Inventory;
use Illuminate\Support\Facades\DB;

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

    public function posTable()
    {
        return view('pos.table');
    }

    public function pos($iTable)
    {
        $oCategories = ProductCategory::all();

        return view('pos.overview', ['oCategories' => $oCategories, 'iTable' => $iTable]);
    }

    public function posCategory($iTable, $iCat)
    {
        $oProducts = Product::all()->where('iCategoryId', $iCat);

        return view('pos.categoryOverview', ['oProducts' => $oProducts, 'iTable' => $iTable]);
    }

    public function posProduct($iTable, $iCat, $iProd)
    {
        $oProduct = Product::all()->where('id', $iProd)->first();

        return view('pos.productOverview', ['oProduct' => $oProduct, 'iTable' => $iTable]);
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

    public function userPreferences()
    {
        return view('user.preferences');
    }

    public function userProfile()
    {
        return view('user.profile');
    }

    public function analyticsSales()
    {
        $oSales = Sales::all()->sortByDesc('created_at')->take(20);
        return view('analytics.sales', ['oSales' => $oSales]);
    }

    public function analyticsProducts()
    {
        $oTopIds = DB::table('product_sales_count')->orderByDesc('count')->take(3)->get();

        $oTopProducts = [];
        foreach ($oTopIds as $i=>$top) {
            $oTopProducts[$i] = new \stdClass();
            $oTopProducts[$i]->sName = Product::where('id', $top->iProductId)->first()->sName;
            $oTopProducts[$i]->count = $top->count;
        }

        return view('analytics.products', ['oTopProducts' => $oTopProducts]);
    }

    public function analyticsTables()
    {
        return view('analytics.tables');
    }
}
