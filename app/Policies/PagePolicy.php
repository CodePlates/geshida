<?php

namespace App\Policies;

use App\Page;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any pages.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		return $user->hasPermission('pages.viewAny');
	}

	/**
	 * Determine whether the user can view the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function view(User $user, Page $page)
	{
		return $user->hasPermission('pages.view');
	}

	/**
	 * Determine whether the user can create pages.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('pages.create');
	}

	/**
	 * Determine whether the user can update the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function update(User $user, Page $page)
	{
		return $user->hasPermission('pages.update');
	}

	/**
	 * Determine whether the user can delete the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function delete(User $user, Page $page)
	{
		return $user->hasPermission('pages.delete');
	}

	/**
	 * Determine whether the user can restore the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function restore(User $user, Page $page)
	{
		return $user->hasPermission('pages.restore');
	}

	/**
	 * Determine whether the user can permanently delete the page.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Page  $page
	 * @return mixed
	 */
	public function forceDelete(User $user, Page $page)
	{
		return $user->hasPermission('pages.forceDelete');
	}
}
