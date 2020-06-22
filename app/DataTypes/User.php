<?php 

namespace App\DataTypes;

use App\FieldTypes\Field;
use App\FieldTypes\Relationship\BelongsTo;

/**
 *  Post datatype for test purpose
 *  will delete later
 */
class User extends DataType {

	protected function build()
	{
		return [
			Field\Text::create('first_name')->required(),
			Field\Text::create('last_name')->required(),
			Field\Text::create('email')->required(),
			Field\Password::create('password'),
			Field\Image::create('avatar'),
			Field\DropDown::create('role')->options(
				new BelongsTo('App\Role')
			),
		];
	}
}