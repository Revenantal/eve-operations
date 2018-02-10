<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operation extends Model
{
    use SoftDeletes;
    public $timestamps = false;
    
    public function createdBy(){
        return $this->belongsTo('App\Models\Auth\User', 'created_by', 'id');
    }

    public function modifiedBy(){
        return $this->belongsTo('App\Models\Auth\User', 'modified_by', 'id');
    }

    public function assignedTo(){
        return $this->belongsTo('App\Models\Auth\User', 'assigned_to', 'id');
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

    public function icons() {
        $icons = [];
        $attributes = $this->keyedAttributes();
        
        if (!empty($attributes['attr_priority'])) {
            switch($attributes['attr_priority']) {
                case 'cta':
                    $icon = ['image' => 'strat-op.png', 'title' => 'Strategic Operation'];
                    break;
                case 'cta':
                    $icon = ['image' => 'cta.png', 'title' => 'Call To Arms'];
                    break;  
                default:
                    $icon = ['image' => 'general-op.png', 'title' => 'General Operation'];
                    break;
            }
            $icons['attr_priority'] = $icon;
        }
                               
        if ($attributes['attr_srp']) {
            $icons['attr_srp'] = ['image' => 'srp.png', 'title' => 'SRP Approved'];
        }

        if (!empty($this->type)) {
            switch($this->type) {
                case 'structure_off':
                    $icon = ['image' => 'structure-off.png', 'title' => $this->friendlyType()];
                    break;
                case 'structure_def':
                    $icon = ['image' => 'structure-def.png', 'title' => $this->friendlyType()];
                    break;  
                case 'roam':
                    $icon = ['image' => 'roam.png', 'title' => $this->friendlyType()];
                    break;  
                case 'moon_mining':
                    $icon = ['image' => 'mining.png', 'title' => $this->friendlyType()];
                    break;     
                default:
                    $icon = ['image' => 'fun.png', 'title' => $this->friendlyType()];
                    break;
            }
            $icons['type'] = $icon;
        }

        if (!empty($attributes['attr_structure_type'])) {
            $icon = ['image' => strToLower($attributes['attr_structure_type']->value) . '.png', 'title' => ucfirst($attributes['attr_structure_type']->value)];
            $icons['attr_structure_type'] = $icon;
        }

        return $icons;

    }
}