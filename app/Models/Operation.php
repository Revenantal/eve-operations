<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Operation extends Model
{
    public function createdBy(){
        return $this->belongsTo('App\User', 'created_by', 'id');
    }

    public function modifiedBy(){
        return $this->belongsTo('App\User', 'modified_by', 'id');
    }

    public function assignedTo(){
        return $this->belongsTo('App\User', 'assigned_to', 'id');
    }

    public function getTimeUntilAttribute()
    {
        $current = Carbon::now();
        $operationTime = Carbon::parse($this->operation_at);
        $difference = $operationTime->diffInSeconds($current);

        $test = Carbon::parse($this->operation_at)->diff(Carbon::now())->format('%dD %hH %mM %sS');
        $test = $operationTime->diffInDays($current);
        $test = $operationTime->diffInMinutes($current);
        


        return $test;
       // return gmdate('d\D H\H i\M s\S', $difference);
    }
}