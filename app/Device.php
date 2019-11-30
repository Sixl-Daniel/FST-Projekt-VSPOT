<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use QrCode;

class Device extends Model
{

    protected static function boot() {
        parent::boot();

        static::creating(function ($query) {
            $query->api_token = Str::random(45);
        });
    }

    /* protect fields */

    protected $fillable = [
        'display_name', 'product_reference', 'description', 'location', 'channel_id'
    ];

    /* private functions */

    private function makeDeviceURL($api = false, $timestamp = false)
    {
        $type = $api ? 'api' : 'web';
        $link = env('APP_URL').'/'.$type.'/v1/'.$this->user->id.'/'.$this->id.'?api_token='.$this->api_token;
        if($timestamp) $link .= '&timestamp';
        return $link;
    }

    /* custom attributes */

    public function getWebURLAttribute()
    {
        return $this->makeDeviceURL();
    }

    public function getWebURLUpdateAttribute()
    {
        return $this->makeDeviceURL(false, true);
    }

    public function getApiURLAttribute()
    {
        return $this->makeDeviceURL(true);
    }

    public function getApiURLUpdateAttribute()
    {
        return $this->makeDeviceURL(true, true);
    }

    public function makeQR($api = false, $timestamp = false, $size = 150, $format = 'png')
    {
        $link = $this->makeDeviceURL($api, $timestamp);
        return QrCode::encoding('UTF-8')
            ->format($format)
            ->size($size)
            ->margin(0)
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
