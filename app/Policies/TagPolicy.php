<?php

namespace App\Policies;

use App\Tag;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any tags.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		return $user->hasPermission('tags.viewAny');
	}

	/**
	 * Determine whether the user can view the tag.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Tag  $tag
	 * @return mixed
	 */
	public function view(User $user, Tag $tag)
	{
		return $user->hasPermission('tags.view');
	}

	/**
	 * Determine whether the user can create tags.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('tags.create');
	}

	/**
	 * Determine whether the user can update the tag.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Tag  $tag
	 * @return mixed
	 */
	public function update(User $user, Tag $tag)
	{
		return $user->hasPermission('tags.update');
	}

	/**
	 * Determine whether the user can delete the tag.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Tag  $tag
	 * @return mixed
	 */
	public function delete(User $user, Tag $tag)
	{
		return $user->hasPermission('tags.delete');
	}

	/**
	 * Determine whether the user can restore the tag.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Tag  $tag
	 * @return mixed
	 */
	public function restore(User $user, Tag $tag)
	{
		return $user->hasPermission('tags.restore');
	}

	/**
	 * Determine whether the user can permanently delete the tag.
	 *
	 * @param  \App\User  $user
	 * @param  \App\Tag  $tag
	 * @return mixed
	 */
	public function forceDelete(User $user, Tag $tag)
	{
		return $user->hasPermission('tags.forceDelete');
	}
}
