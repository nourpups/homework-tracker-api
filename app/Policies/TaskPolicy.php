<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Group $group): bool
    {
        return $user->hasPermissionTo('task_access') &&
            $group->hasUser($user->id);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        return $user->hasPermissionTo('task_show') &&
            $user->belongsToGroup($task->group_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Group $group): bool
    {
        return $user->hasPermissionTo('task_access') &&
            $group->hasUser($user->id);

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {

        return $user->belongsToGroup($task->group_id) && // if user in group where task created and
            $user->hasPermissionTo('task_update'); // can task_update == teacher/admin

        // other group's teacher can't update because teacher isn't in group where task created
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        return $user->belongsToGroup($task->group_id) &&
            $user->hasPermissionTo('task_update');
        // same as update method
    }

}
