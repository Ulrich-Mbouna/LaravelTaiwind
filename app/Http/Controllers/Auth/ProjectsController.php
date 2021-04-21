<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Http\Resources\Project as ProjectResource;
use App\Http\Resources\ProjectCollection;
use App\Http\Requests\ProjectRequest;
// use App\Policies\ProjectPolicy;  

class ProjectsController extends Controller
{

    public function __construct() {
        $this->authorizeResource(Project::class,'project');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects = Project::where('user_id',auth()->user()->id)
                    ->withCount('tasks')
                    // ->select(['id','name','updated_at','created_at'])
                    ->get();

        // return $projects;
        return new ProjectCollection($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        //
        $project = auth()->user()->projects()->create($request->all());

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
        // return $project;
        $tasks = $project->tasks;
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        //
         $project->update($request->all());
        $tasks = $project->tasks;
        return new ProjectResource($project);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
        $project->delete($project);
        return ['status' =>'Delete successful'];
    }
}
