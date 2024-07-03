<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProjectController extends Controller {
    public function index() {
        $projects = Project::withCount(['tasks'])->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function create() {
        return view('projects.create_edit');
    }

    /**
     * @param ProjectRequest $request
     * @return RedirectResponse
     */
    public function store(ProjectRequest $request) {
        Project::create($request->validated());
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function show(Project $project) {
        return $project;
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\Foundation\Application|Factory|\Illuminate\Contracts\View\View|Application|View
     */
    public function edit(Project $project) {
        return view('projects.create_edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project) {
        $project->update($request->validated());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * @param Project $project
     * @return true
     */
    public function destroy(Project $project) {
        $project->delete();
        return true;
    }
}
