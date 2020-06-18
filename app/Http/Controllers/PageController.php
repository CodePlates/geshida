<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Page;
use Illuminate\Http\Request;

class PageController extends CrudController
{

	public function setup()
	{
		$this->crud->setModel(Page::class);
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
		// $this->crud->setFields(['name']);
	}
	

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Page  $page
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(Page $page)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Page  $page
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(Page $page)
	{
		//
	}

}
