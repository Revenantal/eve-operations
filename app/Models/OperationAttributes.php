<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationAttributes extends Model
{
    public function operation(){
        return $this->belongsTo('App\Models\Operation', 'operation_id', 'id');
    }
}
