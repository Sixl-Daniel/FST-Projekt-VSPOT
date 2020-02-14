<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Purifier;

class Screen extends Model implements Sortable
{

    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true
    ];

    protected $touches = ['channel'];

    protected $fillable = [
        'name', 'description',
        'background_color', 'text_color', 'bg_img_cdn_link', 'overlay_color', 'heading', 'subheading', 'html_block', 'text_block'
    ];

    protected $appends = ['layout_name'];

    protected $hidden = [
        'id', 'channel_id', 'layout_id', 'created_at', 'updated_at', 'layout', 'active', 'name', 'description'
    ];

    // sort grouping

    public function buildSortQuery()
    {
        return static::query()->where('channel_id', $this->channel_id);
    }

    // purify html content
    public function setHtmlBlockAttribute($value)
    {
        $this->attributes['html_block'] = Purifier::clean($value);
    }

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

    /* custom attributes */

    public function getLayoutNameAttribute()
    {
        return $this->layout->name;
    }

}
