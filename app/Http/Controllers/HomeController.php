<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Work;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $works = Work::where('user_id', $user->id)->with('task')->orderby('started_at')->get();
        return view('home', ['works'=>$works]);
    }
}
