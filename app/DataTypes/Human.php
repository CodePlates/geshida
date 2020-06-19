<?php 

namespace App\DataTypes;

use App\FieldTypes\Field;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Human extends DataType {

	protected function build()
	{
		return [
			Field\Text::create('name')->required(),
			Field\Dropdown::create('gender')->options(["male", "female"]),
		];
	}
}