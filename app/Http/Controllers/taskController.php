<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\User;
use App\Resource;
use App\Department;
use App\Tag;
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
        $departments = Department::with('tasks')->get();
        $tasks = Task::orderBy('title')->get();
        return view('tasks.index', ['resources'=>$departments]);
    }

    public function indexData(Request $request){

        $query = Task::query();

        if($request->has('start_date') && $request->has('end_date')){
            $query = $query->whereRaw("(startDate <= '".$request->end_date."' AND
            endDate > '".$request->start_date."')");
        }

        if($request->has('department') && $request->department != -1){
            $query = $query->where('department_id', $request->department);
        }

        $query = $query->with('resource', 'dependencies', 'dependson');

        $tasks = $query->get();


        $rows = [];
        $cols = [
                ['id'=>'taskid', 'label'=>'Task ID', 'type'=>'string'], 
                ['id'=>'Task Name','label'=>'Task Name','type'=>'string'],
                ['id'=>'Resource', 'label'=>'Department', 'type'=>'string'],
                ['id'=>'Start Date','label'=>'Start Date', 'type'=>'date'],
                ['id'=>'End Date','label'=>'End Date', 'type'=>'date'],
                ['id'=>'Duration','label'=>'Duration', 'type'=>'number'],
                ['id'=>'Percent Complete','label'=>'Percent Complete', 'type'=>'number'],
                ['id'=>'Dependencies','label'=>'Dependencies', 'type'=>'string']
                ];


        $extratasks = [];
        $extradependson = [];

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
            switch ($request->color) {
                case "department":
                    if(isset($task->department))
                        array_push($row['c'], ['v'=>$task->department->name]);
                    else
                        array_push($row['c'], []);
                    break;
                case "resource":
                    if(isset($task->resource))
                        array_push($row['c'], ['v'=>$task->resource->name]);
                    else
                        array_push($row['c'], []);
                    break;
                case "tag":
                    if(isset($task->tag))
                        array_push($row['c'], ['v'=>$task->tag->name]);
                    else
                        array_push($row['c'], []);
                    break;
                default:
                    array_push($row['c'], []);
            }
            array_push($row['c'], ['v'=>"Date(".$startDate['year'].",".$startDate['month'].",".$startDate['day'].",".$startTime[0].",".$startTime[1].",0,0)"]);
            array_push($row['c'], ['v'=>"Date(".$endDate['year'].",".$endDate['month'].",".$endDate['day'].",".$endTime[0].",".$endTime[1].",0,0)"]);
            array_push($row['c'], []);
            array_push($row['c'], ['v'=>$task->percentcomplete]);
            if(!empty($task->dependencies)){
                $temp = [];
                foreach($task->dependencies as $dependency){
                    $startDate1 = strtotime($request->start_date);
                    $startDate2 = strtotime($dependency->startDate);
                    $endDate1 = strtotime($request->end_date);
                    $endDate2 = strtotime($dependency->endDate);
                    if($startDate1 <= $endDate2 && $startDate2 <= $endDate1){
                        array_push($temp, $dependency->id);
                        array_push($extratasks, $dependency);
                    }
                }
                array_push($row['c'], ['v'=>implode(', ', $temp)]);
            }else{
                array_push($row['c'], []);
            }
            if(!empty($task->dependson)){
                foreach($task->dependson as $dependson){
                    $startDate1 = strtotime($request->start_date);
                    $startDate2 = strtotime($dependson->startDate);
                    $endDate1 = strtotime($request->end_date);
                    $endDate2 = strtotime($dependson->endDate);
                    if($startDate1 <= $endDate2 && $startDate2 <= $endDate1){
                        array_push($extradependson, $dependson);
                    }
                }
            }
            array_push($rows, $row);
        }

        foreach($extratasks as $task){
            if(!$tasks->contains($task->id)){
                $startDate = date_parse($task->startDate);
                $startDate['month'] --;
                $startTime = explode(":",$task->startTime);
                $endDate = date_parse($task->endDate);
                $endDate['month'] --;
                $endTime = explode(":",$task->endTime);
                $row = ['c'=>[]];
                array_push($row['c'], ['v'=>$task->id]);
                array_push($row['c'], ['v'=>$task->title]);
                switch ($request->color) {
                    case "department":
                        if(isset($task->department))
                            array_push($row['c'], ['v'=>$task->department->name]);
                        else
                            array_push($row['c'], []);
                        break;
                    case "resource":
                        if(isset($task->resource))
                            array_push($row['c'], ['v'=>$task->resource->name]);
                        else
                            array_push($row['c'], []);
                        break;
                    case "tag":
                        if(isset($task->tag))
                            array_push($row['c'], ['v'=>$task->tag->name]);
                        else
                            array_push($row['c'], []);
                        break;
                    default:
                        array_push($row['c'], []);
                }
                array_push($row['c'], ['v'=>"Date(".$startDate['year'].",".$startDate['month'].",".$startDate['day'].",".$startTime[0].",".$startTime[1].",0,0)"]);
                array_push($row['c'], ['v'=>"Date(".$endDate['year'].",".$endDate['month'].",".$endDate['day'].",".$endTime[0].",".$endTime[1].",0,0)"]);
                array_push($row['c'], []);
                array_push($row['c'], ['v'=>$task->percentcomplete]);
                array_push($row['c'], []);
                array_push($rows, $row);
            }
        }

        foreach($extradependson as $task){
            if(!$tasks->contains($task->id)){
                $startDate = date_parse($task->startDate);
                $startDate['month'] --;
                $startTime = explode(":",$task->startTime);
                $endDate = date_parse($task->endDate);
                $endDate['month'] --;
                $endTime = explode(":",$task->endTime);
                $row = ['c'=>[]];
                array_push($row['c'], ['v'=>$task->id]);
                array_push($row['c'], ['v'=>$task->title]);
                switch ($request->color) {
                    case "department":
                        if(isset($task->department))
                            array_push($row['c'], ['v'=>$task->department->name]);
                        else
                            array_push($row['c'], []);
                        break;
                    case "resource":
                        if(isset($task->resource))
                            array_push($row['c'], ['v'=>$task->resource->name]);
                        else
                            array_push($row['c'], []);
                        break;
                    case "tag":
                        if(isset($task->tag))
                            array_push($row['c'], ['v'=>$task->tag->name]);
                        else
                            array_push($row['c'], []);
                        break;
                    default:
                        array_push($row['c'], []);
                }
                array_push($row['c'], ['v'=>"Date(".$startDate['year'].",".$startDate['month'].",".$startDate['day'].",".$startTime[0].",".$startTime[1].",0,0)"]);
                array_push($row['c'], ['v'=>"Date(".$endDate['year'].",".$endDate['month'].",".$endDate['day'].",".$endTime[0].",".$endTime[1].",0,0)"]);
                array_push($row['c'], []);
                array_push($row['c'], ['v'=>$task->percentcomplete]);
                if(!empty($task->dependencies)){
                    $temp = [];
                    foreach($task->dependencies as $dependency){
                        if(!$tasks->contains($task->id)){ //only add dependencies on currently filtered tasks
                            array_push($temp, $dependency->id);
                        }
                    }
                    array_push($row['c'], ['v'=>implode(', ', $temp)]);
                }else{
                    array_push($row['c'], []);
                }
                array_push($rows, $row);
            }
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
        $departments = Department::get();
        $tags = Tag::orderBy('name')->get();
        return view('tasks.create', ['tasks'=>$tasks, 'users'=>$users, 'resources'=>$resources, 'departments'=>$departments, 'tags'=>$tags]);
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
            'title' => 'required|unique:tasks',
            'startDate' => 'required',
            'endDate' => 'required',
            'department' => 'required',
        ]);

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

        if($request->has('department')){
            $department = Department::findorfail($request->department);
            $task->department()->associate($department);
        }

        if($request->has('tag')){
            $tag = Tag::findorfail($request->tag);
            $task->tag()->associate($tag);
        }

        $task->save();
        return redirect()->route('tasks.edit', [$task->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::with('manager', 'resource', 'department')->findorfail($id);
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
        $tasks = Task::orderBy('title')->get();
        $resources = Resource::get();
        $departments = Department::get();
        $tags = Tag::orderBy('name')->get();
        return view('tasks.edit', ['task'=>$task, 'users'=>$users, 'tasks'=>$tasks, 'resources'=>$resources, 'departments'=>$departments, 'tags'=>$tags]);
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

        if($request->has('department')){
            $department = Department::findorfail($request->department);
            $task->department()->associate($department);
        }

        if($request->has('tag')){
            $tag = Tag::findorfail($request->tag);
            $task->tag()->associate($tag);
        }

        $task->save();
        return redirect()->route('tasks.edit', [$task->id]);
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
        return redirect()->route('tasks.index');
    }
}
