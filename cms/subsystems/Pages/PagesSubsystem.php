<?php

//namespace Subsystem\Page;

use App\Subsystem;
use App\Crud;
use Subsystem\Page\Models\Page;
use Subsystem\Page\App\Http\Controllers\PageController;
/**
 * 
 */
class PagesSubsystem extends Subsystem
{
	
	protected $prefferedRoutes = ["", "page"];

	protected $name = "Pages";

	public function boot()
	{
		parent::boot();
		
	}

}