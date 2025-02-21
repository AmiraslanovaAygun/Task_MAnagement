<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'project_name' => 'required|string|max:255',
                'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'users' => 'nullable|array',
                'users.*' => 'exists:users,id'
            ]);

            $iconPath = null;
            if ($request->hasFile('icon')) {
                $iconPath = $request->file('icon')->store('project_icons', 'public');
            }

            $project = Project::create([
                'project_name' => $request->project_name,
                'icon' => $iconPath,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => 'todo'
            ]);
            if ($request->users) {
                $project->users()->attach($request->users);
            }

            return redirect()->route('admin.project')->with('success', 'Proyekt uğurla yaradıldı.');
        } catch (\Exception $e) {
            return redirect()->route('admin.project')->with('error', 'Proyekt yaradılarkən xəta baş verdi.');
        }
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
    public function update(Request $request, Project $project)
    {
        try {
            $request->validate([
                'project_name' => 'required|string|max:255',
                'description' => 'required|string|max:500',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'users' => 'array',
                'tasks' => 'array',
            ]);

            $project->update([
                'project_name' => $request->project_name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            $project->users()->sync($request->users);

            if ($request->has('tasks')) {
                foreach ($request->tasks as $taskId => $taskData) {
                    if (is_numeric($taskId)) {
                        Task::where('id', $taskId)->update(['task_name' => $taskData]);
                    } else if ($taskId === "new") {
                        foreach ($taskData as $newTaskName) {
                            $lastTaskNumber = $project->tasks()->max('task_number') ?? 0;
                            $project->tasks()->create([
                                'task_name' => $newTaskName,
                                'task_number' => $lastTaskNumber + 1,
                                'project_id' => $project->id
                            ]);
                        }
                    }
                }
            }
            return redirect()->back()->with('success', 'Profil məlumatları uğurla yeniləndi');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xəta baş verdi');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            if ($project->icon) {
                Storage::delete($project->icon);
            }
            $project->delete();

            return response()->json(['message' => 'Silinmə müvəffəqiyyətlə yerinə yetirildi'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Silinmə zamanı xəta baş verdi'], 500);
        }
    }
}
