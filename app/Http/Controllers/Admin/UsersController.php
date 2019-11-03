<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
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
            $users = User::verified()->paginate(6);
            return view('backend.admin.users.index')
                ->with('users', $users);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@index"!');
            // return redirect()->route('dashboard')->with('flash-error', "Die Benutzer können wegen eines Fehlers nicht angezeigt werden.");
            return back()->with('flash-error', "Die Benutzer können wegen eines Fehlers nicht angezeigt werden.");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRegistrations()
    {
        try
        {
            $users = User::unverified()->paginate(6);
            return view('backend.admin.users.index_registrations')
                ->with('users', $users);
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@indexRegistrations"!');
            // return redirect()->route('dashboard')->with('flash-error', "Die Registrierungen (unverifizierte Benutzer) können wegen eines Fehlers nicht angezeigt werden.");
            return back()->with('flash-error', "Die Registrierungen (unverifizierte Benutzer) können wegen eines Fehlers nicht angezeigt werden.");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // no editing of superadmins
        if($user->is('superadmin')) {
            // return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht editiert werden.');
            return back()->with('flash-error', 'Superadministratoren dürfen nicht editiert werden.');
        }

        try
        {
            $standardRolesAvailable = Role::standard()->pluck('name', 'id');
            return view('backend.admin.users.edit')
                ->with([
                    'user' => $user,
                    'rolesAvailable' => $standardRolesAvailable
                ]);
        }
        catch(Exception $e)
        {
            Log::error('Fehler in "UsersController@edit"!');
            // return redirect()->route('dashboard')->with('flash-error', "Der Benutzer $user->name kann wegen eines Fehlers nicht editiert werden.");
            return back()->with('flash-error', "Der Benutzer $user->name kann wegen eines Fehlers nicht editiert werden.");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, User $user)
    {
        // no updating of superadmins
        if($user->is('superadmin')) {
            // return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht verändert werden.');
            return back()->with('flash-error', 'Superadministratoren dürfen nicht verändert werden.');
        }

        // validate
        $request->validate([
            'username' => 'required | alpha_dash | max:32 | unique:users,username,'.$user->id,
            'email' => 'required | string | email | max:128 | unique:users,email,'.$user->id,
            'first_name' => 'required | string | max:128',
            'last_name' => 'required | string | max:128'
        ]);

        // update and save
        try
        {
            $user->roles()->sync($request->roles);
            $user->fill($request->all())->save();
            // return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde aktualisiert.");
            return back()->with('flash-success', "Der Benutzer $user->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@update"!');
            // return redirect()->route('admin.users.index')->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht aktualisiert werden.");
            return back()->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht aktualisiert werden.");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        // no deleting of superadmins
        if($user->is('superadmin'))
        {
            // return redirect()->route('admin.users.index')->with('flash-error', 'Der Benutzer $user->name ist Superadministrator und kann nicht gelöscht werden.');
            return back()->with('flash-error', 'Der Benutzer $user->name ist Superadministrator und kann nicht gelöscht werden.');
        }

        try {
            $user->delete();
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Fehler in "UsersController@destroy"!');
            // return redirect()->route('admin.users.index')->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht gelöscht werden.");
            return back()->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht gelöscht werden.");
        }
    }

}
