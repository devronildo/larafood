<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name', 'email', 'password', 'tenant_id'
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function evaluations(){
        return $this->hasMany(Evaluation::class);
    }
}
