<?php

namespace App\Http\Controllers;

use App\Models\Project;
// use App\Http\Requests\StoreProjectRequest;
// use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
     /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Project::class, 'project');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $projects=auth()->user()->projects->with('tools')->get();
        $projects=Project::with('tools')->where('id',auth()->user()->id)->get();
        return response()->json($projects,200);
    }

  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:projects|string|max:30',
            'sub_title' => 'required|unique:projects|string|max:50',
            'github_repo' => 'nullable|url:http,https',
            'host_url' => 'nullable|url:http,https',
        ], [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute must be unique.',
            'url' => 'The :attribute must be a valid HTTP or HTTPS URL.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute must not be greater than :max characters.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $project = Project::create([
           'title'=>$request->title,
           'sub_title'=>$request->sub_title,
           'github_repo'=>$request->has('github_repo') ? $request->github_repo :null,
           'host_url'=>$request->has('host_url') ? $request->host_url : null ,
           'user_id'=>auth()->user()->id
        ]);

        $project->tools()->attach($request->tools);
        // $user->roles()->attach($roleId);
        
        return response()->json([
            'message' => 'Project created seccufully',
            // 'project'=>$request->all()
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return response()->json($project,200);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'unique:projects|string|max:30',
            'sub_title' => 'unique:projects|string|max:50',
            'github_repo' => 'url:http,https',
            'host_url' => 'url:http,https',
        ], [
            'unique' => 'The :attribute must be unique.',
            'url' => 'The :attribute must be a valid HTTP or HTTPS URL.',
            'string' => 'The :attribute must be a string.',
            'max' => 'The :attribute must not be greater than :max characters.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
       $project->update($request->all());
      return response()->json([
        'message'=>'updated secc',
        // 'project'=>$project,
        // 'req'=>$request->all()

      ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        Project::destroy($project->id);
        return response()->json([
            'message'=>'deleted secc'
          ],200);
    }
}
