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

        $standardRolesAvailable = Role::standard()->pluck('name', 'id');

        //dd($standardRoles);

        return view('backend.admin.users.edit')
            ->with([
                'user' => $user,
                'rolesAvailable' => $standardRolesAvailable
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

        // validate
        $this->validate(
            $request,
            [
            'username' => 'required | alpha_dash | max:32 | unique:users,username,'.$user->id,
            'email' => 'required | string | email | max:128 | unique:users,email,'.$user->id,
            'first_name' => 'required | string | max:128',
            'last_name' => 'required | string | max:128'
            ]
        );

        // update and save

        try
        {
            $user->roles()->sync($request->roles);
            $user->fill($request->all())->save();
            return redirect()->route('admin.users.index')->with('flash-success', "Der Benutzer $user->name wurde aktualisiert.");
        }
        catch(ModelNotFoundException $e)
        {
            Log::error('Something is really going wrong in UsersController.');
            return redirect()->route('admin.users.index')->with('flash-error', "Der Benutzer $user->name konnte wegen eines Fehlers nicht aktualisiert werden.");
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
