<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller {

    public function index(Project $project) {
        $tasks = $project->tasks()->orderBy('priority')->get();
        return view('projects.tasks.index', compact('tasks', 'project'));
    }

    public function create(Project $project) {
        $projects = Project::select(['id', 'name'])->get();
        return view('projects.tasks.create_edit', [
            'project' => $project,
            'projects' => $projects,
        ]);
    }

    public function store(Project $project, TaskRequest $request) {
        $task = Task::create($request->validated());
        return redirect()->route('projects.tasks.index', $task->project->id)
            ->with('success', 'Task created successfully');
    }

    public function show(Project $project, Task $task) {
        return $project->tasks()->findOrFail($task->id);
    }

    public function edit(Project $project, Task $task) {
        $projects = Project::select(['id', 'name'])->get();
        return view('projects.tasks.create_edit', [
            'task' => $task,
            'project' => $project,
            'projects' => $projects,
        ]);
    }

    /**
     * @param TaskRequest $request
     * @param Task $task
     * @return RedirectResponse
     */
    public function update(TaskRequest $request, Task $task) {
        $task->update($request->validated());

        return redirect()->route('projects.tasks', $task->project->id)
            ->with('success', 'Task updated successfully');
    }


    /**
     * @param Project $project
     * @param Task $task
     * @return true
     */
    public function destroy(Project $project, Task $task) {
        $project->tasks()->findOrFail($task->id)->delete();
        return true;
    }

    public function reorder(Project $project, Request $request) {
        $request->validate([
            'task_ids' => ['required', 'array'],
            'task_ids.*' => ['required', 'integer', 'exists:tasks,id']
        ]);

        $taskIds = $request->get('task_ids');

        $caseStatements = '';
        foreach ($taskIds as $priority => $taskId) {
            $caseStatements .= "WHEN $taskId THEN $priority ";
        }
        $updateQuery = "CASE id $caseStatements END";
        $project->tasks()->whereIn('id', array_values($taskIds))
            ->update([
                'priority' => DB::raw($updateQuery)
            ]);

        return true;
    }
}
