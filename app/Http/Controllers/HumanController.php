<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Human;
use Illuminate\Http\Request;

class HumanController extends CrudController
{

	public function setup()
	{
		$this->crud->setModel(Human::class);
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
	 * @param  \App\Human  $human
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(Human $human)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Human  $human
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(Human $human)
	{
		//
	}

}
