<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends CrudController
{

	public function setup()
	{
		$this->crud->setModel(Role::class);
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
	 * @param  \App\Role  $role
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(Role $role)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Role  $role
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(Role $role)
	{
		//
	}

}
