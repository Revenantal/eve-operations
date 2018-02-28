<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationAttribute extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'value', 'hidden'];

    public function operation(){
        return $this->belongsTo('App\Models\Operation', 'operation_id', 'id');
    }
}
