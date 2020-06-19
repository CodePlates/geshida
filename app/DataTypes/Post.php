<?php 
namespace App\DataTypes;

use App\FieldTypes\Field;
/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Post extends DataType {

  protected function build()
  {
    return [
      Field\Text::create('title')->required(),
      Field\TextArea::create('excerpt'),
    ];
  }
}