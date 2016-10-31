<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
	
	/**
     * The table associated with the model.
     *
     * @var string
     */
	protected $table = 'workson';

    public function user(){
    	return $this->belongsTo('App\User', 'user_id');
    }

    public function task(){
    	return $this->belongsTo('App\Task', 'task_id');
    }
}
