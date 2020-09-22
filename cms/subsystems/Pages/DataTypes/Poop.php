<?php 

namespace Subsystem\Pages\DataTypes;

use App\DataTypes\DataType;
use App\FieldTypes\Field;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Poop extends DataType {

	protected function build()
	{
		return [
			Field\Text::create('name')->required(),
		];
	}
}