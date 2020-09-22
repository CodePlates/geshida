<?php 

namespace Subsystem\Pages\DataTypes;

use App\FieldTypes\Field;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Page extends DataType {

	protected function build()
	{
		return [
			Field\Text::create('title'),
			Field\Image::create('image')->default('default.png'),
		];
	}
}