<?php

namespace App;

use App\CrudModel;
use App\Datatypes\Post as PostDatatype;

class Post extends CrudModel
{
    
   static $datatype = PostDatatype::class;

}