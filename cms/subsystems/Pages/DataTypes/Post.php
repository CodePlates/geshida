<?php 

namespace Subsystem\Pages\DataTypes;

use App\DataTypes\DataType;
use App\FieldTypes\Field;
use App\FieldTypes\Relationship\BelongsTo;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Post extends DataType {

	protected function build()
	{
		return [
			Field\Text::create('name')->required(),
			Field\DropDown::create('page')->options(
				new BelongsTo('Subsystem\Pages\Models\Page', 'page_id')
			),
		];
	}
}