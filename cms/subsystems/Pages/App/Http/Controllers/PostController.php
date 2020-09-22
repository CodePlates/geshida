<?php

namespace Subsystem\Pages\App\Http\Controllers;

use Illuminate\Http\Request;
use Subsystem\Pages\Http\Controllers\CrudController;
use Subsystem\Pages\Models\Post;

class PostController extends CrudController
{

	public function setup()
	{
		$this->crud->setModel(Post::class);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function setupIndex($query)
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function setupCreate()
	{
		//
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(Post $post)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \Subsystem\Pages\Models\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(Post $post)
	{
		//
	}

}
