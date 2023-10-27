<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Group;
use App\Models\Task;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Group $group)
    {
        $this->authorize('viewAny', [Task::class, $group]);

        $tasks = $group->tasks()->get();

        return new TaskCollection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request, Group $group)
    {
        $this->authorize('create', [Task::class, $group]);

        $data = $request->validated();

        $task = $group->tasks()->create($data);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        $task->load(['group', 'answers']);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskUpdateRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $data = $request->validated();

        $task->update($data);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('view', $task);

        $task->answers()->delete();
        $task->delete();

        return response()->noContent();
    }
}
