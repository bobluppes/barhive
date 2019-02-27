<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\konvaTable;

class KonvaTableController extends Controller
{
    public function getLayout()
    {
        $layout = konvaTable::all()->where('property', 'layout')->first();
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

    public function getPosLayout()
    {
        $layout = konvaTable::all()->where('property', 'posLayout')->first();
        return $layout;
    }

    public function savePosLayout(Request $oRequest)
    {

        // Check if layout property already exitst
        $layout = konvaTable::where('property', 'posLayout');

        if ($layout->count() == 0) {
            $konva = new konvaTable();
        } else {
            $konva = $layout->first();
        }

        $konva->property = 'posLayout';
        $konva->json = $oRequest->jsonLayout;
        $konva->save();
    }

    public function getAnalyticsLayout()
    {
        $layout = konvaTable::all()->where('property', 'analyticsLayout')->first();
        return $layout;
    }

    public function saveAnalyticsLayout(Request $oRequest)
    {

        // Check if layout property already exitst
        $layout = konvaTable::where('property', 'analyticsLayout');

        if ($layout->count() == 0) {
            $konva = new konvaTable();
        } else {
            $konva = $layout->first();
        }

        $konva->property = 'analyticsLayout';
        $konva->json = $oRequest->jsonLayout;
        $konva->save();
    }
}
