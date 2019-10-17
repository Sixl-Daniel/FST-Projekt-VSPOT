<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    // relationships

    /**
     * Get the devices of the channel.
     */

    public function devices ()
    {
        return $this->hasMany('App\Device');
    }

    /**
     * Get the screens of the channel.
     */

    public function screens ()
    {
        return $this->hasMany('App\Screen');
    }

}
