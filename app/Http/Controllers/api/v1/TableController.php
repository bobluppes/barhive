<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 5-1-2019
 * Time: 21:50
 */

namespace App\Http\Controllers\api\v1;

use App\Table;
use Illuminate\Http\Request;

class TableController
{

    public function createTable(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'table' => 'required|int',
        ]);

        $oTable = new Table();
        $oTable->iTableId = $validatedData['table'];
        $oTable->sCurrentStatus = 'empty';
        $oTable->iSaved = 0;
        $oTable->save();
    }

    public function renameTable(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'old' => 'required|int',
            'new' => 'required|int',
        ]);

        // Check if there already is a rename waiting to be saved
        $oTableRename = Table::where('iTableId', $validatedData['old'])->where('iSaved', 0);
        if ($oTableRename->count() > 0) {
            $oTable = $oTableRename->first();
            $sOldStatus = $oTable->sCurrentStatus;
        } else {
            $oTable = Table::where('iTableId', $validatedData['old'])->first();
            $oTable->iSaved = -1;
            $sOldStatus = $oTable->sCurrentStatus;
            $oTable->save();

            $oTable = new Table();
        }

        $oTable->iTableId = $validatedData['new'];
        $oTable->sCurrentStatus = $sOldStatus;
        $oTable->iSaved = 0;
        $oTable->save();
    }

    public function deleteTable(Request $oRequest)
    {
        $validatedData = $oRequest->validate([
            'table' => 'required|int',
        ]);

        $oTable = Table::where('iTableId', $validatedData['table'])->first();
        $oTable->delete();
    }

    public function noSave()
    {
        // Unmark delete all tables waiting to be deleted
        $toDelete = Table::where('iSaved', -1);
        $toDelete->update(['iSaved' => 1]);

        // Delete all unsaved tables
        $unsavedTables = Table::where('iSaved', 0);
        $unsavedTables->delete();
    }

    public function save()
    {
        // Save all unsaved tables
        $unsavedTables = Table::where('iSaved', 0);
        $unsavedTables->update(['iSaved' => 1]);

        // Delete all tables waiting to be deleted
        $toDelete = Table::where('iSaved', -1);
        $toDelete->delete();
    }

    public function status($id)
    {
        $oTable = Table::where('iTableId', $id)->first();
        $sStatus = $oTable->sCurrentStatus;

        return $sStatus;
    }

}