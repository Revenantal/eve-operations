<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'eve_token', 'username', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function created_operations(){
        return $this->hasMany('App\Models\Operation', 'created_by');
    }

    public function modified_operations(){
        return $this->hasMany('App\Models\Operation', 'modified_by');
    }

    public function assigned_operations(){
        return $this->hasMany('App\Models\Operation', 'assigned_to');
    }
}
