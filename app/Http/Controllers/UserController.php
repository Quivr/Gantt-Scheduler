<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Http\Requests;

class UserController extends Controller
{

    public function show($id){
        $user = User::findorfail($id);
        return view('auth.show', ['user'=>$user]);
    }
}
