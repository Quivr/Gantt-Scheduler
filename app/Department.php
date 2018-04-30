<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function tasks(){
		return $this->hasMany('App\Task', 'resource_id');
	}
}
