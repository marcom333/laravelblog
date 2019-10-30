<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Project;

class ProjectTasksController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function update(Task $task){
    	$task->update([
    		"completed"=>request()->has("completed")
    	]);
    	return back();
    }

    public function store(Project $project){
        $project->addTask(request()->validate([
        	"description"=>["required","min:3"]
        ]));
        return back();
    }

    public function destroy(Task $task){
    	$task->delete();
    	return back();
    }
}
