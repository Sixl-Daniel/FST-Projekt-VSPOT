<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function scopeStandard($query) {
        return $query->where('name', '!=', 'superadmin')->get();
    }

    // relationships

    /**
     * Get the users that own the role.
     */

    public function users () {
        return $this->belongsToMany('App\User');
    }

}
