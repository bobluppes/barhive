<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'sName', 'sComment', 'sDepartment', 'iSaleId', 'iTableId',
    ];

    public function sale()
    {
        return $this->belongsTo('App\Sale', 'iSaleId');
    }
}
