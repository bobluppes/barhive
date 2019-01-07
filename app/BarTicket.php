<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarTicket extends Model
{
    protected $fillable = [
        'iProductId',
        'sComment',
    ];
}
