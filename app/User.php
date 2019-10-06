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
        'username', 'first_name', 'last_name', 'email', 'password', 'is_admin', 'approved_at', 'rejected_at'
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
        'is_admin' => 'boolean',
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /* append custom attributes */

    public function getIsAdminAttribute()
    {
        return $this->is_admin;
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getRejectedAttribute()
    {
        return $this->rejected_at == null ? false : true;
    }

    public function getApprovedAttribute()
    {
        return $this->approved_at == null ? false : true;
    }

    public function getPendingAttribute()
    {
        return ($this->approved_at == null && $this->rejected_at == null) ? true : false;
    }


    /* local scopes */

    public function scopeAdmins($query) {
        return $query->where('is_admin', 1);
    }

    public function scopeConsumers($query) {
        return $query->where('is_admin', 0);
    }

    public function scopeRejected($query) {
        return $query->where('rejected_at', '!=', null);
    }

    public function scopeApproved($query) {
        return $query->where('approved_at', '!=', null);
    }

    public function scopePending($query) {
        return $query
                ->where('approved_at', null)
                ->where('rejected_at', null);
    }
}
