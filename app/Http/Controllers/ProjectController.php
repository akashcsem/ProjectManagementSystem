<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\User;
use App\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects'=>$projects]);
    }

    public function addProjectUser(Request $request){
      $project = Project::find($request->project_id);

      if (Auth::user()->id == $project->user_id) {
        $user = User::where('email', $request->email)->first();
    
        if ($user && $project) {
          $project->users()->attach($user->id);
          return redirect()->route('projects.show', ['project'=> $project->id])
          ->with('success', $request->input('email') . ' was added to the project successfully');
        }
      }
      return redirect()->route('projects.show', ['project'=> $project->id])
      ->with('error', 'Error adding to the project.');
    }
    /**
     * Show data insert form/page
     */
    public function create($company_id = null)
    {
        $companies = null;
        if (!$company_id) {
          $companies = Company::where('user_id', Auth::user()->id)->get();
        }
        return view ('projects.create', ['company_id'=>$company_id, 'companies'=>$companies]);
    }

    /**
     * Store/save data
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
          $project = Project::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'company_id'=>$request->company_id,
            'user_id'=>Auth::user()->id
          ]);
        }
        if ($project) {
          return redirect()->route('projects.show', $project->id)
          ->with('success', 'Project created successful');
        }
        return back()->withInput()->with('error', 'Some error occure.');
    }

    /**
     * Display details of a individual item
     */
    public function show(Project $project)
    {
      $project = Project::find($project->id);
      return view('projects.show', ['project'=>$project]);
    }

    /**
     * Secify a item and return to edit form with detail
     */
    public function edit(Project $project)
    {
      $project = Project::find($project->id);
      return view('projects.edit', ['project'=>$project]);
      // $project = Project::where('id', $project->id)->first();
    }

    /**
     * Update data item
     */
    public function update(Request $request, Project $project)
    {
      $projectUpdate = Project::where('id', $project->id)
                                ->update([
                                  'name'=>$request->name,
                                  'description'=>$request->description
                                ]);
      if ($projectUpdate) {
        return redirect()->route('projects.show', $project->id)
        ->with('success', 'Project updated successful');
      }
      return back()->withInput()->with('error', 'Some error occure.');
    }

    /**
     * Delete/Destroy/Remove a specific item
     */
    public function destroy(Project $project)
    {
        $projectDelete = Project::find($project->id)->delete();
        if ($projectDelete) {
          return redirect()->route('projects.index')
          ->with('success', 'Project deleted successful');
        }
        return back()->withInput()->with('error', 'Some error occure.');
    }
}
