<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Mail\ProjectMail;
use App\Events\ProjectCreated;

class ProjectController extends Controller
{

    public function __construct(){
        $this->middleware('auth'); // all of actions
        //$this->middleware('auth')->only(['store','update']); // only the selected
        //$this->middleware('auth')->except(['action1','action2']); // all except the selected
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where("owner_id",auth()->id())->get();
        //return $projects; // retorna un JSON con los datos de los proyectos
        /*return view("projects.index")->with([
            "projects"=>$projects,
        ]);*/
        return view("projects.index",compact("projects"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("projects.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$project = new Project();
        $project->title = request('title');
        $project->description = request('description');
        $project->save();
        //return request()->all();*/
        $attributes = 
            request()->validate([
                "title"=>[
                    "required",
                    'min:3'
                ],
                "description"=>[
                    "required",
                    "min:3"
                ]
            ]);
        $attributes["owner_id"]=auth()->id();
        //dd($attributes);
        $project = Project::create($attributes);
        session()->flash("flash","The project \"$project->title\" was created succesful.");

        event(new ProjectCreated($project));

        \Mail::to("dev.marco.medina@gmail.com")->send(
            new ProjectMail($project)
        );

        return redirect('/projects/'.$project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //abort_if(!auth()->user()->owns($project),403);
        //abort_unless(auth()->user()->owns($project),403);
        //abort_if($project->owner_id !== auth()->id,403);
        //abort_unless(\Gate::allows('update',$project),403);
        //abort_if(\Gate::denies('update',$project),403);
        //$this->authorize('view',$project);
        //$project = Project::where("id",$project)->first();
        return view("projects.show",["project"=>$project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view("projects.edit",["project"=>$project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $attributes = 
            request()->validate([
                "title"=>[
                    "required",
                    'min:3'
                ],
                "description"=>[
                    "required",
                    "min:3"
                ]
            ]);
        $project->update($attributes);
        return redirect('/projects/'.$project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //dd("Se destruye el mal ". $project->title);
        $project->delete();
        return redirect("/projects");
    }
}
