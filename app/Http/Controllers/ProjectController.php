<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(10);
        return view('admin.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $types = Type::all();
        $request->validate([
            'title'=> 'required|unique:projects|min:3|max:255',
            'type'=> 'required|exists:types,id',
            'topic'=> 'required|unique:projects|min:3|max:255',
            'gitHub'=> 'required|unique:projects|min:5|max:255',
            'image' => 'required|image'
        ]);
        $data = $request->all();

        if ($request->hasFile('image')){
            $img_path = Storage::put('uploads/projects', $request['image']);
            $data['image'] = $img_path;
        }

        $newProject = new Project();
        $newProject->title = $data['title'];
        $newProject->type_id = $data['type'];
        $newProject->topic = $data['topic'];
        $newProject->date = date('y-m-d');
        $newProject->gitHub = $data['gitHub'];
        $newProject->slug = '';
        $newProject->image = $data['image'];
        $newProject->save();
        $newProject->slug = Str::of("$newProject->id " . $data['title'])->slug('-');
        $newProject->save();

        return redirect()->route('projects.show', $newProject);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {
        $project = Project::findOrFail($slug);
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.edit', compact('project'), compact('types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $project = Project::findOrFail($id);
        $data = $request->validate([
            'title'=> ['required',Rule::unique('projects')->ignore($project->id),'min:3','max:255'],
            'type'=> 'required|exists:types,id',
            'topic'=> ['required',Rule::unique('projects')->ignore($project->id),'min:3','max:255'],
            'gitHub'=> ['required',Rule::unique('projects')->ignore($project->id),'min:5','max:255'],
            'image' => ['image']
        ]);
        
        $data = $request->all();

        if ($request->hasFile('image')){
            Storage::delete($project->image);
            $img_path = Storage::put('uploads/projects', $request['image']);
            $data['image'] = $img_path;
        }

        $project->title = $data['title'];
        $project->type_id = $data['type'];
        $project->topic = $data['topic'];
        $project->date = date('y-m-d');
        $project->gitHub = $data['gitHub'];
        $project->slug = Str::of("$project->id " . $data['title'])->slug('-');
        $project->image = $data['image'];
        $project->save();

        return redirect()->route('projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function trashed()
    {
        $projects = Project::onlyTrashed()->paginate(10);

        return view('admin.trashed', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();
        return redirect()->route('projects.show', compact('project'));
    }
    
    public function obliterate($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        Storage::delete($project->image);
        $project->forceDelete();

        return redirect()->route('admin.trashed');
    }
}
