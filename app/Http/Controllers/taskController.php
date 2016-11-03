<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\User;
use App\Resource;
use DB;

use App\Http\Requests;

class taskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::with('tasks')->get();
        $tasks = Task::orderBy('title')->get();
        return view('tasks.index', ['resources'=>$resources]);
    }

    public function indexData(Request $request){

        if($request->has('start_date') && $request->has('end_date')){
            $tasks = Task::whereRaw("startDate between '".$request->start_date."' and '"."2020-01-01"."'")
                            ->whereRaw("endDate between '"."2016-01-01"."' and '".$request->end_date."'")
                            ->with('subTasks','resource')->get();
        }else{
            $tasks = Task::with('subTasks','resource')->get();
        }


        $rows = [];
        $cols = [
                ['id'=>'taskid', 'label'=>'Task ID', 'type'=>'string'], 
                ['id'=>'Task Name','label'=>'Task Name','type'=>'string'],
                ['id'=>'Resource', 'label'=>'Resource', 'type'=>'string'],
                ['id'=>'Start Date','label'=>'Start Date', 'type'=>'date'],
                ['id'=>'End Date','label'=>'End Date', 'type'=>'date'],
                ['id'=>'Duration','label'=>'Duration', 'type'=>'number'],
                ['id'=>'Percent Complete','label'=>'Percent Complete', 'type'=>'number'],
                ['id'=>'Dependencies','label'=>'Dependencies', 'type'=>'string']
                ];

        foreach ($tasks as $task) {
            $startDate = date_parse($task->startDate);
            $startDate['month'] --;
            $startTime = explode(":",$task->startTime);
            $endDate = date_parse($task->endDate);
            $endDate['month'] --;
            $endTime = explode(":",$task->endTime);
            $row = ['c'=>[]];
            array_push($row['c'], ['v'=>$task->id]);
            array_push($row['c'], ['v'=>$task->title]);
            if(isset($task->resource))
                array_push($row['c'], ['v'=>$task->resource->name]);
            else
                array_push($row['c'], []);
            array_push($row['c'], ['v'=>"Date(".$startDate['year'].",".$startDate['month'].",".$startDate['day'].",".$startTime[0].",".$startTime[1].",0,0)"]);
            array_push($row['c'], ['v'=>"Date(".$endDate['year'].",".$endDate['month'].",".$endDate['day'].",".$endTime[0].",".$endTime[1].",0,0)"]);
            array_push($row['c'], []);
            array_push($row['c'], ['v'=>$task->percentcomplete]);
            if(!empty($task->dependencies)){
                // $temp = [];
                // foreach($task->dependencies as $dependency){
                //     array_push($temp, $dependency->id);
                // }
                // array_push($row['c'], ['v'=>implode(', ', $temp)]);
            }else{
                array_push($row['c'], []);
            }
            array_push($rows, $row);
        }

        $data = ['cols'=>$cols, 'rows'=>$rows];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = Task::get();
        $users = User::get();
        $resources = Resource::get();
        return view('tasks.create', ['tasks'=>$tasks, 'users'=>$users, 'resources'=>$resources]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task;

        $task->title = $request->title;
        $task->description = $request->description;
        if($request->has('startDate'))
            $task->startDate = $request->startDate;
        if($request->has('endDate'))
            $task->endDate = $request->endDate;

        if($request->has('manager')){
            $user = User::findorfail($request->manager);
            $task->manager()->associate($user);
        }

        if($request->has('master_task')){
            $masterTask = Task::findorfail($request->master_task);
            $task->masterTask()->associate($masterTask);
        }

        if($request->has('resource')){
            $resource = Resource::findorfail($request->resource);
            $task->resource()->associate($resource);
        }

        $task->save();
        return redirect()->route('tasks.show', [$task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with('manager')->findorfail($id);
        return view('tasks.show', ['task'=>$task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::with('dependencies')->findorfail($id);
        $users = User::get();
        $tasks = Task::get();
        $resources = Resource::get();
        return view('tasks.edit', ['task'=>$task, 'users'=>$users, 'tasks'=>$tasks, 'resources'=>$resources]);
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
        $task = Task::findorfail($id);

        $task->title = $request->title;
        $task->description = $request->description;
        $task->startDate = $request->startDate;
        $task->startTime = $request->startTime;
        $task->endDate = $request->endDate;
        $task->endTime = $request->endTime;
        $task->percentcomplete = $request->percentcomplete;

        if($request->has('manager')){
            $user = User::findorfail($request->manager);
            $task->manager()->associate($user);
        }else{
            $task->manager()->dissociate();
        }

        if($request->has('master_task')){
            $masterTask = Task::findorfail($request->master_task);
            $task->masterTask()->associate($masterTask);
        }else{
            $task->masterTask()->dissociate();
        }

        if($request->has('resource')){
            $resource = Resource::findorfail($request->resource);
            $task->resource()->associate($resource);
        }else{
            $task->resource()->dissociate();
        }

        if($request->has('dependency')){
            $dependency = Task::findorfail($request->dependency);
            $task->dependencies()->save($dependency);
        }

        $task->save();
        return redirect()->route('tasks.show', [$task->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createDependency(Request $request, $id)
    {
        $task = Task::findorfail($id);

        if($request->has('dependency')){
            $dependency = Task::findorfail($request->dependency);
            $task->dependencies()->attach($dependency);
        }

        return redirect()->route('tasks.edit', [$task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id1
     * @param  int  $id2
     * @return \Illuminate\Http\Response
     */
    public function destroyDependency($id1, $id2){
        $task = Task::findorfail($id1);
        $task->dependencies()->detach($id2);

        return redirect()->route('tasks.edit', [$task->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::destroy($id);
        return back();
    }
}
