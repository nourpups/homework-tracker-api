<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GroupPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('group_access');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Group $group): bool
    {
        return $user->hasPermissionTo('group_show') &&
            $group->hasUser($user->id);

    }

//    /**
//     * Determine whether the user can create models.
//     */
//    public function create(User $user): bool
//    {
//        return $user->hasPermissionTo('group_create');
//    }
//
//    /**
//     * Determine whether the user can update the model.
//     */
//    public function update(User $user, Group $group): bool
//    {
//        return $user->hasPermissionTo('group_update');
//    }
//
//    /**
//     * Determine whether the user can delete the model.
//     */
//    public function delete(User $user, Group $group): bool
//    {
//        return $user->hasPermissionTo('group_update');
//    }

}
