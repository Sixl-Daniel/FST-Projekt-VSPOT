<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{

    protected $touches = ['channel'];

    protected $fillable = [
        'name', 'description',
        'background_color', 'text_color', 'bg_img_cdn_link', 'bg_img_opacity', 'overlay_color', 'heading', 'subheading', 'html_block'
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
