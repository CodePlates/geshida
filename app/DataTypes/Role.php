<?php 

namespace App\DataTypes;

use App\FieldTypes\Field;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Role extends DataType {

	protected function build()
	{
		return [
			Field\Text::create('name')->required(),
			Field\Text::create('display_name')->required(),
			Field\TextArea::create('description'),
		];
	}
}