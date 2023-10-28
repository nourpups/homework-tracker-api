<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\GroupStoreRequest;
use App\Http\Requests\GroupUpdateRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', [Group::class]);

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
//        dd(
//            $group->users->pluck('id'),
//            auth()->id(),
//            $group->hasUser(auth()->id()),
//            $group->users()
//                ->where('user_id', auth()->id())
//                ->first()
//        );
        $this->authorize('view', $group);

        $group->load(['teacher', 'students', 'tasks']);

        return new GroupResource($group);
    }

}
