<?php 
namespace App\DataTypes;

use App\FieldTypes\Field;
use App\FieldTypes\Relationship\{BelongsTo, BelongsToMany};
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
      Field\Dropdown::create('human')->options(
      	new BelongsTo('App\Human')
      ),
      Field\Dropdown::create('luman')->options(
        new BelongsTo('App\Human')
      ),
      Field\Tags::create('tags')->options(
        new BelongsToMany('App\Tag', 'post_tags')
      ),
    ];
  }
}