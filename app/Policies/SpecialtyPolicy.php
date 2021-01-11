<?php

namespace App\Policies;

use App\Models\Specialty;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialtyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specialty  $specialty
     * @return mixed
     */
    public function view(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->has_role(config('app.admin_role'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specialty  $specialty
     * @return mixed
     */
    public function update(User $user, Specialty $specialty)
    {
        return $user->has_role(config('app.admin_role'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specialty  $specialty
     * @return mixed
     */
    public function delete(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specialty  $specialty
     * @return mixed
     */
    public function restore(User $user, Specialty $specialty)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Specialty  $specialty
     * @return mixed
     */
    public function forceDelete(User $user, Specialty $specialty)
    {
        //
    }
}
