<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function manager(){
    	return $this->belongsTo('App\User', 'manager_id');
    }

    public function resource(){
    	return $this->belongsTo('App\Resource', 'resource_id');
    }

    public function masterTask(){
    	return $this->belongsTo('App\Task', 'master_task_id');
    }

    public function subTasks(){
    	return $this->hasMany('App\Task','master_task_id');
    }

}
