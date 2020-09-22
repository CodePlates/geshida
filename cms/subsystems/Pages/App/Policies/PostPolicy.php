<?php

namespace Subsystem\Pages\App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Subsystem\Pages\Models\Post;

class PostPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can view any posts.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function viewAny(User $user)
	{
		return $user->hasPermission('posts.viewAny');
	}

	/**
	 * Determine whether the user can view the post.
	 *
	 * @param  \App\User  $user
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return mixed
	 */
	public function view(User $user, Post $post)
	{
		return $user->hasPermission('posts.view');
	}

	/**
	 * Determine whether the user can create posts.
	 *
	 * @param  \App\User  $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->hasPermission('posts.create');
	}

	/**
	 * Determine whether the user can update the post.
	 *
	 * @param  \App\User  $user
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return mixed
	 */
	public function update(User $user, Post $post)
	{
		return $user->hasPermission('posts.update');
	}

	/**
	 * Determine whether the user can delete the post.
	 *
	 * @param  \App\User  $user
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return mixed
	 */
	public function delete(User $user, Post $post)
	{
		return $user->hasPermission('posts.delete');
	}

	/**
	 * Determine whether the user can restore the post.
	 *
	 * @param  \App\User  $user
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return mixed
	 */
	public function restore(User $user, Post $post)
	{
		return $user->hasPermission('posts.restore');
	}

	/**
	 * Determine whether the user can permanently delete the post.
	 *
	 * @param  \App\User  $user
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return mixed
	 */
	public function forceDelete(User $user, Post $post)
	{
		return $user->hasPermission('posts.forceDelete');
	}
}
