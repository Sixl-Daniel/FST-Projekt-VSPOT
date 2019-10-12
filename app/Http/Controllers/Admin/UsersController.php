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
            $users = User::verified()->get();
            $unverifiedUsers = User::unverified()->get();
            return view('backend.admin.users.index')
                ->with('users', $users)
                ->with('unverifiedUsers', $unverifiedUsers);
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
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
            return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht editiert werden.');
        }

        $standardRoles = Role::standard();
        return view('backend.admin.users.edit')
            ->with([
                'user' => $user,
                'roles' => $standardRoles
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // no updating of superadmins
        if($user->is('superadmin')) {
            return redirect()->route('admin.users.index')->with('flash-error', 'Superadministratoren dürfen nicht verändert werden.');
        }

        try {
            $user->roles()->sync($request->roles);
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // no deleting of superadmins
        if($user->is('superadmin'))
        {
            return redirect()->route('admin.users.index')->with('flash-error', 'Der Benutzer $user->name ist Superadministrator und kann nicht gelöscht werden.');
        }

        try {
            // $user->roles()->detach(); // -> on delete cascade via db
            $user->delete();
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde gelöscht.");
        }
        catch(ModelNotFoundException $e)
        {
            dd(get_class_methods($e));
            dd($e);
        }
    }

}
