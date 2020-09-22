<?php

namespace Subsystem\Pages\Models;

use App\CrudModel;
//use App\DataTypes\Page as PageDatatype;

class Page extends CrudModel
{    
   protected static $datatype = PageDatatype::class;
   
}