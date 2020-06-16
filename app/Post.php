<?php

namespace App;

use App\CrudModel;
use App\Datatypes\Post as PostDatatype;

class Post extends CrudModel
{
    
   private static $datatype = PostDatatype::class;

}