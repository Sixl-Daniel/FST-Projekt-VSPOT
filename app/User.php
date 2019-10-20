<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'first_name', 'last_name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'email_verified_at'
    ];

    /* check roles */

    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name', $roles)->first()) return true;

        return false;
    }

    public function is($role)
    {
        if($role == 'guest') return empty($this->roles()->get()->toArray()) ? true : false;

        if($this->roles()->where('name', $role)->first()) return true;

        return false;
    }

    /* custom attributes */

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getGuestAttribute()
    {
        return empty($this->roles()->get()->toArray()) ? true : false;
    }

    public function getRoleIdsAttribute()
    {
        return $this->roles()->get()->pluck('id')->toArray();
    }

    public function getRoleNamesAttribute()
    {
        return $this->roles()->get()->pluck('name')->toArray();
    }

    /* local scopes */

    public function scopeGuests() {
        return User::whereDoesntHave('roles')->get();
    }

    public function scopeAdministrators() {
        return Role::whereName('admin')->first()->users()->whereNotNull('email_verified_at')->get();
    }

    public function scopeSuperadministrators() {
        return Role::whereName('superadmin')->first()->users()->whereNotNull('email_verified_at')->get();
    }

    public function scopeAdministrators_all()
    {
        $regularAdmins = Role::whereName('admin')->first()->users()->whereNotNull('email_verified_at')->get();
        $superAdmins = Role::whereName('superadmin')->first()->users()->whereNotNull('email_verified_at')->get();
        $allAdmins = $regularAdmins->merge($superAdmins);
        return $allAdmins->all();
    }

    public function scopeUser()
    {
        return Role::whereName('user')->first()->users()->whereNotNull('email_verified_at')->get();
    }

    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at')->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
    }

    public function scopeUnverified($query)
    {
        return $query->whereNull('email_verified_at')->orderBy('last_name', 'ASC')->orderBy('first_name', 'ASC');
    }

    /* relationships */

    public function roles ()
    {
        return $this->belongsToMany('App\Role');
    }

    public function devices ()
    {
        return $this->hasMany('App\Device');
    }

    public function channels ()
    {
        return $this->hasMany('App\Channel');
    }

}
