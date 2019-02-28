<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Setting;
use App\Table;
use Hamcrest\Core\Set;
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

        $bNewCat = session('bNewCat', false);
        session(['bNewCat' => false]);
        if ($bNewCat) {
            $iActiveCat = ProductCategory::orderBy('id', 'DESC')->first()->id;
        } else {
            $iActiveCat = session('cat', null);
            session(['cat' => null]);
        }



        return view('inventory.overview', ['oCategories' => $oCategories, 'oProducts' => $oProducts, 'iActiveCat' => $iActiveCat]);
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

    public function editCategory($id)
    {
        $oCategory = ProductCategory::where('id', $id)->first();
        return view('inventory.editCategory', ['oCategory' => $oCategory]);
    }

    public function posTable()
    {
        $bDontOrderOnTable = Setting::where('setting', 'dontOrderOnTable')->first()->value;
        if ($bDontOrderOnTable == 1) {
            return redirect('pos/-1');
        }

        return view('pos.table');
    }

    public function pos($iTable)
    {
        $oCategories = ProductCategory::all();
        $oTable = Table::where('iTableId', $iTable)->first();
        $bDontOrderOnTable = Setting::where('setting', 'dontOrderOnTable')->first()->value;

        return view('pos.overview', ['oCategories' => $oCategories, 'oTable' => $oTable, 'bDontOrderOnTable' => $bDontOrderOnTable]);
    }

    public function posCategory($iTable, $iCat)
    {
        $oProducts = Product::all()->where('iCategoryId', $iCat);
        $bQuickOrder = Setting::where('setting', 'quickOrder')->first()->value;

        return view('pos.categoryOverview', ['oProducts' => $oProducts, 'iTable' => $iTable, 'bQuickOrder' => $bQuickOrder]);
    }

    public function posProduct($iTable, $iCat, $iProd)
    {
        $oProduct = Product::all()->where('id', $iProd)->first();

        return view('pos.productOverview', ['oProduct' => $oProduct, 'iTable' => $iTable]);
    }

    public function posPay($iTable)
    {
        $oTable = Table::where('iTableId', $iTable)->first();
        $oBill = $oTable->getBill();
        $oSales = $oBill->sales;

        return view('pos.pay', ['oTable' => $oTable, 'oBill' => $oBill, 'oSales' => $oSales]);
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
        $curr = Setting::where('setting', 'curr')->first()->value;
        return view('settings.management', ['curr' => $curr]);
    }

    public function posSettings()
    {
        $oSettings = Setting::all();
        return view('settings.pos', ['oSettings' => $oSettings]);
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

    public function reservations()
    {
        return view('reservations.overview');
    }
}
