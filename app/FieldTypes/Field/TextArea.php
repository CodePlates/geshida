<?php

namespace App\FieldTypes\Field;

use App\FieldTypes\FieldType;

class TextArea extends FieldType
{
  public function getDbColumnType()
  {
    return 'text';
  }

  public function getFormField()
  {
    return 'textarea';
  }
}
