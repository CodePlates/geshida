<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends CrudController
{

	public function setup()
	{
		$this->crud->setModel(Tag::class);
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
	 * @param  \App\Tag  $tag
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(Tag $tag)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Tag  $tag
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(Tag $tag)
	{
		//
	}

}
