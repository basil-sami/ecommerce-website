<?php
// app/Policies/AdminPolicy.php
namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create admins.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->is_admin; // Check if user is an admin
    }

    /**
     * Determine whether the user can update the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return bool
     */
    public function update(User $user, Admin $admin)
    {
        return $user->is_admin; // Check if user is an admin
    }

    /**
     * Determine whether the user can delete the admin.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin  $admin
     * @return bool
     */
    public function delete(User $user, Admin $admin)
    {
        return $user->is_admin; // Check if user is an admin
    }
}
