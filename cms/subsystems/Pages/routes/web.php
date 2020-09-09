<?php 

Route::get("/", "PageController@index");

Route::get("/{slug}", "PageController@view");