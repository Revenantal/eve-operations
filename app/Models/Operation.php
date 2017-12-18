<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public $timestamps = false;
    
    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function modifiedBy(){
        return $this->belongsTo('App\User', 'modified_by', 'id');
    }

    public function assignedTo(){
        return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function operationAttributes(){
        return $this->hasMany('App\OperationAttribute', 'operation_id');
    }
}