<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use App\Http\Controllers\CrudController;
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
		$permissions = Permission::all()->groupBy('group');
		$this->crud->appendData(compact('permissions'));
	}

	public function afterSave(Request $request, Role $role)
	{
		$role->syncPermissions($request->permissions);
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
		$permissions = Permission::all()->groupBy('group');
		$this->crud->appendData(compact('permissions'));
	}

}
