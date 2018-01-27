<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * Attributes that should be filled in
     *
     * @var array
     */
    protected $fillable = [
        'character_id',
        'character_name',
        'corporation_id',
        'alliance_id',
        'last_login',
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