<?php

namespace App\Http\Controllers;

use App\FieldTypes\Field\Text;
use App\Http\Controllers\CrudController;
use App\User;
use Illuminate\Http\Request;

class UserController extends CrudController
{

	public function setup()
	{
		$this->crud->setModel(User::class);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function setupIndex($query)
	{
		$this->crud->setFields([
			'avatar',
			Text::create('full_name'),
			'email',
			'role',
		]);
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
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function setupShow(User $user)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function setupEdit(User $user)
	{
		//
	}

}
