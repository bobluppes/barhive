<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class konvaTable extends Model
{
    protected $fillable = [
        'property',
        'json',
    ];
}
