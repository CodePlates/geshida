<?php

namespace ;

use App\Human;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HumanPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any humans.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		return $user->hasPermission('humans.viewAny');
	}

	/**
	 * Determine whether the user can view the human.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Human  $human
	 * @return mixed
	 */
	public function view(User $user, Human $human)
	{
		return $user->hasPermission('humans.view');
	}

	/**
	 * Determine whether the user can create humans.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('humans.create');
	}

	/**
	 * Determine whether the user can update the human.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Human  $human
	 * @return mixed
	 */
	public function update(User $user, Human $human)
	{
		return $user->hasPermission('humans.update');
	}

	/**
	 * Determine whether the user can delete the human.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Human  $human
	 * @return mixed
	 */
	public function delete(User $user, Human $human)
	{
		return $user->hasPermission('humans.delete');
	}

	/**
	 * Determine whether the user can restore the human.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Human  $human
	 * @return mixed
	 */
	public function restore(User $user, Human $human)
	{
		return $user->hasPermission('humans.restore');
	}

	/**
	 * Determine whether the user can permanently delete the human.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Human  $human
	 * @return mixed
	 */
	public function forceDelete(User $user, Human $human)
	{
		return $user->hasPermission('humans.forceDelete');
	}
}
