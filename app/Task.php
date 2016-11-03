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

    public function dependencies(){
        return $this->belongsToMany('App\Task','dependson', 'task_dependson_id', 'task_id');
    }

    public function dependson(){
        return $this->belongsToMany('App\Task','dependson', 'task_id', 'task_dependson_id');
    }

    public function workedon(){
        return $this->belongsToMany('App\Task','workson', 'task_id', 'user_id')->withPivot('started_at', 'ended_at', 'id');
    }

}
