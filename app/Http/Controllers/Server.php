<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Server extends Controller
{
    public function deploy(){
    	SSH::run(array(''
		));
    }
}
