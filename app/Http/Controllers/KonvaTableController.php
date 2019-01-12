<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\konvaTable;

class KonvaTableController extends Controller
{
    public function getLayout()
    {
        $layout = konvaTable::all()->where('property', 'layout');

        return $layout;
    }

    public function saveLayout(Request $oRequest)
    {

        // Check if layout property already exitst
        $layout = konvaTable::where('property', 'layout');

        if ($layout->count() == 0) {
            $konva = new konvaTable();
        } else {
            $konva = $layout->first();
        }

        $konva->property = 'layout';
        $konva->json = $oRequest->jsonLayout;
        $konva->save();
    }
}
