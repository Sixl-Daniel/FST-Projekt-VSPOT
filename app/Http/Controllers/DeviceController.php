<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PDF;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $user = auth()->user();
            $devices = $user->devices()->orderBy('display_name', 'asc')->paginate(6);
            return view('backend.signage.devices.index')
                ->with('devices', $devices);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@index"!');
            return back()->with('flash-error', "Die Geräte des Benutzers können wegen eines Fehlers nicht angezeigt werden.");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
            return view('backend.signage.devices.create');
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@create"!');
            return back()->with('flash-error', "Das Formular zum Anlegen eines neuen Gerätes konnte wegen eines Fehlers nicht angezeigt werden.");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'display_name' => [
                'required',
                'alpha_dash',
                'max:32',
                Rule::unique('devices')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'product_reference' => 'nullable | string | max:64',
            'location' => 'nullable | string | max:32',
            'description' => 'nullable | string | max:64'
        ]);

        // save
        try
        {
            $device = new Device();
            $device->fill($request->all());
            $device->user()->associate(auth()->user());
            $device->save();
            return redirect()->route('devices.index')->with('flash-success', "Das neue Gerät $device->display_name wurde angelegt.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@store"!');
            return back()->with('flash-error', "Das neue Gerät konnte wegen eines Fehlers nicht angelegt werden.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return redirect()->route('devices.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        try
        {
            $channels = auth()->user()->channels()->orderBy('name','asc')->pluck('name', 'id');
            $channels['0'] = 'Ohne Channel';
            return view('backend.signage.devices.edit')
                ->with('channels', $channels)
                ->with('device', $device);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "DeviceController@edit"!');
            return back()->with('flash-error', "Das Gerät $device->display_name kann wegen eines Fehlers nicht editiert werden.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Device $device)
    {
        $user = auth()->user();

        // validate

        $request->validate([
            'display_name' => [
                'required',
                'alpha_dash',
                'max:32',
                Rule::unique('devices')->ignore($device)->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                })
            ],
            'product_reference' => 'nullable | string | max:64',
            'location' => 'nullable | string | max:32',
            'description' => 'nullable | string | max:128',
            'channel_id' => 'nullable | exists:channels,id',
        ]);

        // update and save

        try
        {
            $channelId = $request->channel;
            if($channelId === 0) {
                $device->channel()->associate(null);
            } else {
                $newChannel = auth()->user()->channels()->find($channelId);
                $device->channel()->associate($newChannel);
            }
            $device->fill($request->all())->save();
            return redirect()->route('devices.index')->with('flash-success', "Das Gerät $device->display_name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@update"!');
            return back()->with('flash-error', "Das Gerät $device->display_name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {

        // if(auth()->user()->devices()->count() < 2)
        // {
        //     return back()->with('flash-error', 'Das letzte verbleibende Gerät darf nicht gelöscht werden.');
        // }

        try {
            $device->delete();
            return redirect()->route('devices.index')->with('flash-success', "Das Gerät $device->display_name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "DeviceController@destroy"!');
            return back()->with('flash-error', "Das Gerät $device->display_name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }

}

