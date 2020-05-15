<?php 
namespace App\DataTypes;

/**
 *  Post datatype for test purpose
 *  will delete later
 */
class Post extends DataType {

  protected $fields = [
    [
      'name' => 'title',
      'type' => 'text',
    ],
    [
      'name' => 'excerpt',
      'type' => 'textarea'
    ]
  ];
}