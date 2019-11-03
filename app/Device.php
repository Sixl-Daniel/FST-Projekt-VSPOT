<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use QrCode;

class Device extends Model
{

    protected $fillable = [
        'display_name', 'product_reference', 'description', 'location', 'channel_id'
    ];

    /* custom attributes */

    private function makePublicURL($api = false, $timestamp = false)
    {
        $type = $api ? 'api' : 'web';
        $link = env('APP_URL').'/'.$type.'/v1/'.$this->user->id.'/'.$this->id.'?api_token='.$this->user->api_token;
        if($timestamp) $link .= '&timestamp';
        return $link;
    }

    public function getWebURLAttribute()
    {
        return $this->makePublicURL();
    }

    public function getWebURLUpdateAttribute()
    {
        $link = $this->makePublicURL(false, true);
    }

    public function getApiURLAttribute()
    {
        return $this->makePublicURL(true);
    }

    public function getApiURLUpdateAttribute()
    {
        $link = $this->makePublicURL(true, true);
    }

    public function makeQR($api = false, $timestamp = false, $size = 160, $format = 'png')
    {
        $link = $this->makePublicURL($api, $timestamp);
        return QrCode::encoding('UTF-8')
            ->format($format)
            ->size($size)
            ->backgroundColor(255,255,255)
            ->color(0,0,0)
            ->generate($link);
    }

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
