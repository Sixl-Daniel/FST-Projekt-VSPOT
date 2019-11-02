<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class WebAccessController extends Controller
{
    public function respond_v1(Request $request, $user_id, $device_id)
    {

        \Debugbar::disable();

        $user = User::find($user_id);

        // no access if provided user id is not matching provided token
        if($user->api_token != $request->api_token) abort(403, 'Unberechtigter Zugriff');

        // get device
        $device = $user->devices->find($device_id);

        // check if request is for timestamp only and provide latest timestamp as json
        if($request->exists('timestamp')) {
            $lastUpdate = $device->updated_at->timestamp;
            if($device->channel && $device->channel->updated_at->timestamp > $lastUpdate)
                $lastUpdate = $device->channel->updated_at->timestamp;
            return response()->json([
                'lastUpdate' => $lastUpdate
            ]);
        }

        // open view with information, if no channel

        if(!$device->channel) return view('web.access')
            ->with('noChannel', true)
            ->withUser($user)
            ->withDevice($device);

        $channel = $device->channel;

        // deliver channel and screens otherwise

        $screens = $channel->screens;
        return view('web.access')
            ->with('noChannel', false)
            ->withUser($user)
            ->withDevice($device)
            ->withChannel($channel)
            ->withScreens($screens);
    }
}
