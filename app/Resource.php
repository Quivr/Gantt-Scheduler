<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
	public function tasks(){
		return $this->hasMany('App\Task', 'resource_id');
	}
	
}
