<?php

namespace App\Http\Controllers;
 
use App\Models\Projects;
use App\Models\Tasks;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Redirect;

 
class TasksController extends Controller
{
    /**
     * List all tasks
     */
    public function show($project_id = NULL): View
    {
        $projects = Projects::all();
        $tasks = Tasks::select('tasks.*','projects.project_name')->leftjoin('projects','tasks.project_id','=','projects.id')->orderBy('tasks.priority','ASC')->get();
        return view('tasks.tasks', compact('projects','tasks'));
    }

    /**
     * Form to add tasks
     */
    public function add(): View
    {
        $projects = Projects::all();
        return view('tasks.addtasks', compact('projects'));
    }

    /**
     * Function to store tasks
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|max:100',
            // 'project_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        $total_tasks = Tasks::all()->count();

        $task = new Tasks();
        $task->task_name = $request['task_name'];
        $task->project_id = $request['project_id'];
        $task->priority = $total_tasks+1; //The newest addition should be last in priority unless changed on listing screen

        $task->save();
        return Redirect::back()->withSuccess('Task saved successfully');

    }


    /**
     * Re-ordering priority
     */
    public function priority_reorder(Request $request)
    {
        $tasks = Tasks::all();

        foreach ($tasks as $task) {

            foreach ($request->priorityOrder as $order) {

                if ($order['id'] == $task->id) {

                    $task->update(['priority' => $order['priority']]);
                }
            }
        }

        return response(['message' => 'Order updated successfully'], 200);

    }
    
    /**
     * Edit form for task with id
     */
    public function edit(int $id): View
    {
        $projects = Projects::all();
        $task = Tasks::where('id',$id)->first();
        if($task){
            return view('tasks.edittask', compact('projects','task'));
        }else{
            abort(404); // To avoid editing data of an id that doesn't exist
        }
    }

    /**
     * Update logic to fix id
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'task_name' => 'required|max:100',
            // 'project_id' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        $task = Tasks::find($id);
        $task->update([
            $task->task_name = $request['task_name'],
            $task->project_id = $request['project_id']
        ]);

        return Redirect::back()->withSuccess('Task updated successfully');

    }
}