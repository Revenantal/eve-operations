<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Whitelist extends Model
{
    protected $fillable = [
        'corporation_id',
        'corporation_name',
        'alliance_id',
        'alliance_name',
    ];
}
