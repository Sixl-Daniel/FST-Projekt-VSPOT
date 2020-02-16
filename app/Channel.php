<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'name', 'description', 'display_time', 'transition_time', 'refresh_time', 'uses_parallax', 'effect',
        'direction', 'web_is_public', 'api_is_public'
    ];

    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];

    protected $casts = [
        'uses_parallax' => 'boolean',
        'web_is_public' => 'boolean',
        'api_is_public' => 'boolean'
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
