<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Layout extends Model
{

    // relationships

    /**
     * Get the screens of the layout.
     */

    public function screens () {
        return $this->hasMany('App\Screen');
    }
}
