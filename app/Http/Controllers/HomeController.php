<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Work;
use DateTime;

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
        $works = Work::where('user_id', $user->id)->with('task')->orderby('date', 'desc')->orderby('started_at', 'desc')->get();
        $weeks = [];
        foreach ($works as $work) {
            $date = new DateTime($work->date);
            $week = $date->format("W");
            if(isset($weeks[$week])){
                array_push($weeks[$week], $work);
            }else{
                $weeks[$week] = [$work];
            }
        }
        return view('home', ['weeks'=>$weeks]);
    }
}
