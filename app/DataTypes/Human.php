<?php 

namespace App\DataTypes;

use App\FieldTypes\Field;
use App\FieldTypes\Relationship\BelongsTo;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Human extends DataType {

	protected function build()
	{
		
		return [
			Field\Text::create('name')->required(),
			Field\Dropdown::create('gender')->options([
				'm' => "male", 
				'f' => "female"
			]),
			Field\DropDown::create('role')->options(
				new BelongsTo('App\Role', 'position_id')
			),
		];
	}
}