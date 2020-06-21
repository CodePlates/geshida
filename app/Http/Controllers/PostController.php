<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Post;
use Illuminate\Http\Request;

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
		$query->latest();		
		$this->crud->setFields(['title', 'human']);
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
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(Post $post)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Post  $post
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(Post $post)
	{
		//
	}

}
