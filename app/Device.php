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

    private function makePublicURL()
    {
        return env('APP_URL').'/web/v1/'.$this->user->id.'/'.$this->id.'?api_token='.$this->user->api_token;
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

    public function getQrAttribute()
    {
        $link = $this->makePublicURL();
        return QrCode::encoding('UTF-8')
            ->size(270)
            ->backgroundColor(255,255,255)
            ->color(51,51,51)
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
