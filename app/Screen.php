<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{

    protected $fillable = [
        'name', 'description'
    ];

    // relationships

    /**
     * Get the channel that owns the screen.
     */

    public function channel ()
    {
        return $this->belongsTo('App\Channel');
    }

    /**
     * Get the layout that the screen uses.
     */

    public function layout ()
    {
        return $this->belongsTo('App\Layout');
    }

}
