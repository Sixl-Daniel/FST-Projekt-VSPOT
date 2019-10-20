<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
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
            $channels = $user->channels()->orderBy('name', 'asc')->paginate(6);
            return view('backend.signage.channels.index')
                ->with('channels', $channels);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@index"!');
            return back()->with('flash-error', "Die Channels des Benutzers können wegen eines Fehlers nicht angezeigt werden.");
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
            return view('backend.signage.channels.create');
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@create"!');
            return back()->with('flash-error', "Das Formular zum Anlegen eines neuen Channels konnte wegen eines Fehlers nicht angezeigt werden.");
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
        $this->validate(
            $request,
            [
                'name' => 'required | alpha_dash | max:32 | unique:channels',
                'description' => 'nullable | string | max:64'
            ]
        );
        // save
        try
        {
            $channel = new Channel();
            $channel->fill($request->all());
            $channel->user()->associate(auth()->user());
            $channel->save();
            return redirect()->route('channels.index')->with('flash-success', "Der neue Channel $channel->name wurde angelegt.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@store"!');
            return back()->with('flash-error', "Der neue Channel konnte wegen eines Fehlers nicht angelegt werden.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return redirect()->route('channels.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        try {
        return view('backend.signage.channels.edit')
                ->with('channel', $channel);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "ChannelController@edit"!');
            return back()->with('flash-error', "Der Channel $channel->name kann wegen eines Fehlers nicht editiert werden.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        // validate
        $this->validate(
            $request,
            [
                'name' => 'required | alpha_dash | max:32 | unique:channels,name,'.$channel->id,
                'description' => 'nullable | string | max:64'
            ]
        );
        // update and save
        try
        {
            $channel->fill($request->all())->save();
            return redirect()->route('channels.index')->with('flash-success', "Der Channel $channel->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@update"!');
            return back()->with('flash-error', "Der Channel $channel->name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Channel  $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        try {
            $channel->delete();
            return redirect()->route('channels.index')->with('flash-success', "Der Channel $channel->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "ChannelController@destroy"!');
            return back()->with('flash-error', "Der Channel $channel->name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }
}
