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

    public function friendlyType() {
        $friendlyType = "";

        switch ($this->type) {
            case 'structure_off':
                $friendlyType = 'Structure Offensive';
                break;
            case 'structure_def':
            $friendlyType = 'Structure Defensive';
                break;
            case 'roam':
                $friendlyType = 'Roam';
                break;
            case 'general':
                $friendlyType = 'General Fleet';
                break;
            case 'fun':
                $friendlyType = 'Fun Fleet';
                break;
            case 'moon_mining':
                $friendlyType = 'Moon Mining';
                break;
        }

        return $friendlyType;
    }

    public function keyedAttributes() {
        return $this->operationAttributes->keyBy('name');
    }
}