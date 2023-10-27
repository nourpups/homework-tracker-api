<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $query = $user->groups();

        if($user->hasRole('teacher')) {
            $query->with(['teacher', 'students']);
        }
        // if student we dont need to load additional relations
        $groups = $query->get();

        return new GroupCollection($groups);
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        $group->load(['teacher', 'students', 'tasks']);

        return new GroupResource($group);
    }

}
