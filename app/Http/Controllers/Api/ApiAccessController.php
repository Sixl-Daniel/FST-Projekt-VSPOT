<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use stdClass;

class ApiAccessController extends Controller
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

        // if no channel return empty json
        if(!$device->channel) return response()->json(new stdClass());

        // deliver channel and screens otherwise

        $channel = $device->channel;
        $screens = $channel->screens;

        $layoutConfig = config('vspot.layouts');
        $screenContentTypes = config('vspot.screen_content_types');

        foreach ($screens as $index => $screen) {

            if($screen->active != 1) {
                unset($screens[$index]);
                continue;
            };

            // get layout configuration
            $layout = strtolower($screen->layout_name);
            $screenConfig = array_key_exists($layout, $layoutConfig) ? $layoutConfig[$layout] : [];

            // delete properties that are not in configuration configuration
            foreach ($screenContentTypes as $type) {
                if(!in_array($type, $screenConfig)) unset($screen->$type);
            }

        }

        return response()->json($channel);

    }
}
