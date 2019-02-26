<?php
/**
 * Created by PhpStorm.
 * User: boblu
 * Date: 26/02/2019
 * Time: 21:36
 */

namespace App\Http\Controllers\api\v1;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController
{
    public function set(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'setting' => 'required|string',
            'value' => 'required|int',
        ]);

        // Set the setting
        $oSetting = Setting::where('setting', $validatedData['setting'])->first();
        $oSetting->value = $validatedData['value'];
        $oSetting->save();
    }
}