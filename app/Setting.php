<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function getSymbol() {
        if ($this->setting != 'curr') {
            return null;
        }

        switch ($this->value) {
            case 0:
                return '€';
                break;
            case 1:
                return '$';
                break;
            case 2:
                return '£';
                break;
        }
    }
}
