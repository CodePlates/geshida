<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any roles.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		return $user->hasPermission('roles.viewAny');
	}

	/**
	 * Determine whether the user can view the role.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Role  $role
	 * @return mixed
	 */
	public function view(User $user, Role $role)
	{
		return $user->hasPermission('roles.view');
	}

	/**
	 * Determine whether the user can create roles.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('roles.create');
	}

	/**
	 * Determine whether the user can update the role.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Role  $role
	 * @return mixed
	 */
	public function update(User $user, Role $role)
	{
		return $user->hasPermission('roles.update');
	}

	/**
	 * Determine whether the user can delete the role.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Role  $role
	 * @return mixed
	 */
	public function delete(User $user, Role $role)
	{
		return $user->hasPermission('roles.delete');
	}

	/**
	 * Determine whether the user can restore the role.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Role  $role
	 * @return mixed
	 */
	public function restore(User $user, Role $role)
	{
		return $user->hasPermission('roles.restore');
	}

	/**
	 * Determine whether the user can permanently delete the role.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Role  $role
	 * @return mixed
	 */
	public function forceDelete(User $user, Role $role)
	{
		return $user->hasPermission('roles.forceDelete');
	}
}
