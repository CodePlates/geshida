<?php

namespace App;

use App\CrudModel;
use App\DataTypes\Page as PageDatatype;

class Page extends CrudModel
{    
   protected static $datatype = PageDatatype::class;
   
}