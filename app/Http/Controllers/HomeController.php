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
            $work['duration'] = abs(strtotime($work->started_at) - strtotime($work->ended_at));
            $date = new DateTime($work->date);
            $week = $date->format("W")-6;
            if(isset($weeks[$week])){
                array_push($weeks[$week]["works"], $work);
                $weeks[$week]["duration"] = $weeks[$week]["duration"]+$work->duration;
            }else{
                $weeks[$week] = ["works"=>[$work],"duration"=>$work->duration];
            }
        }
        return view('home', ['weeks'=>$weeks]);
    }
}
