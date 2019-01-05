<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KitchenTicket extends Model
{
    protected $fillable = [
        'iProductId',
        'sComment',
    ];
}
