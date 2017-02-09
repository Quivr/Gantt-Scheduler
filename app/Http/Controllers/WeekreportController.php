<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weekreport;

class WeekreportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Weekreport::get();
        return view('reports.index', ['reports'=>$reports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'weeknumber' => 'required|unique:weekreports',
        ]);

        $report = new Weekreport;
        $report->weeknumber = $request->weeknumber;

        if($request->has('startmeeting')){
            $report->startmeeting = $request->startmeeting;
        }

        if($request->has('endmeeting')){
            $report->endmeeting = $request->endmeeting;
        }

        $report->save();
        return redirect()->route('weekreports.show', [$report->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Weekreport::findorfail($id);
        return view('reports.show', ['report'=>$report]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Weekreport::findorfail($id);
        return view('reports.edit', ['report'=>$report]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $report = Weekreport::findorfail($id);

        if($request->has('startmeeting')){
            $report->startmeeting = $request->startmeeting;
        }
        if($request->has('endmeeting')){
            $report->endmeeting = $request->endmeeting;
        }

        $report->save();

        return redirect()->route('weekreports.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
