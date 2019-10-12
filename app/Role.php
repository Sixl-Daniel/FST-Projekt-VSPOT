<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users () {
        return $this->belongsToMany('App\User');
    }

    public function scopeStandard($query) {
        return $query->where('name', '!=', 'superadmin')->get();
    }
}
