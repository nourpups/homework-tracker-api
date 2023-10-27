<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\Controller;
use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new GroupCollection(Group::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupStoreRequest $request)
    {
        $group = Group::create($request->validated());

        return new GroupResource($group);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $group->load(['teacher', 'students', 'tasks']);

        return new GroupResource($group);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateRequest $request, Group $group)
    {
        $group->update($request->validated());

        return new GroupResource($group);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        DB::transaction(function () use ($group) {
            $group->users()->detach();

            $group->load('tasks');
            foreach ($group->tasks as $task) {
                $task->answers()->delete();
            }
            $group->tasks()->delete();

            $group->delete();
        });

        return response()->noContent();
    }
}
