<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name', 'description', 'display_time_ms', 'transition_time_ms', 'refresh_time_ms'
    ];

    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];

    // relationships

    /**
     * Get the user that owns the channel.
     */
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

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
