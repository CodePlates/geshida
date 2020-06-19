<?php

namespace App\FieldTypes\Field;

use App\FieldTypes\FieldType;

/**
 * 
 */
class Text extends FieldType
{
  public function getDbColumnType()
  {
    return ['string', 50];
  }

  public function getFormField()
  {
    return 'text';
  }
}
