<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects = Project::byName($request->name)
            ->byCategory($request->category)
            ->byDescription($request->description)
            ->where('status', 'active')
            ->orderBy('name')
            ->paginate(5)->withQueryString();

        $finished = Project::where('status', 'finished')->orderBy('name')->get();
        return response()->json([
            'projects' => ProjectResource::collection($projects),
            'previous_work' => ProjectResource::collection($finished),
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required|string|max:255|unique:projects',
            'description' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
            'money' => 'required|integer|min:1',

        ]);

        // Check if the user uploads an image to the Project
        if (!$request->has('image')) {
            //return default Project image
            $attributes['image'] = asset('project.jpg');
        }else{
            // name the image and store it
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            $attributes['image'] = $request->file('image')->storeAs('/projects/projectImages', $imageName , 'public');
        }

        $attributes['user_id'] = Auth::guard('api')->id();

        $project = Project::create($attributes);

        return response()->json([
            'message' => 'تمت إضافة المشروع بنجاح  ',
            'project' => new ProjectResource($project),
        ],200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
