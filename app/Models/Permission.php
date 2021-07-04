<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'description'];

    public function profiles(){
        return $this->belongsToMany(Profile::class);
    }

    /*Get Roles */

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

}


