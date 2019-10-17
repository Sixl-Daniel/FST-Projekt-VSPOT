<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{

    protected $fillable = [
        'display_name', 'product_reference', 'description', 'location'
    ];

    // relationships

    /**
     * Get the user that owns the device.
     */
    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the post that owns the comment.
     */
    public function channel ()
    {
        return $this->belongsTo('App\Channel');
    }

}
