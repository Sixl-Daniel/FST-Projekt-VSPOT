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

    private function makePublicURL($api = false)
    {
        $type = $api ? 'api' : 'web';
        return env('APP_URL').'/'.$type.'/v1/'.$this->user->id.'/'.$this->id.'?api_token='.$this->user->api_token;
    }

    public function getWebURLAttribute()
    {
        return $this->makePublicURL();
    }

    public function getWebURLUpdateAttribute()
    {
        $link = $this->makePublicURL();
        return  $link .= '&timestamp';
    }

    public function getApiURLAttribute()
    {
        return $this->makePublicURL(true);
    }

    public function getApiURLUpdateAttribute()
    {
        $link = $this->makePublicURL(true);
        return  $link .= '&timestamp';
    }

    private function makeQR($api = false)
    {
        $link = $this->makePublicURL($api);
        return QrCode::encoding('UTF-8')
            ->size(270)
            ->backgroundColor(255,255,255)
            ->color(51,51,51)
            ->generate($link);
    }

    public function getWebQrAttribute()
    {
        return $this->makeQR();
    }

    public function getApiQrAttribute()
    {
        return $this->makeQR(true);
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
