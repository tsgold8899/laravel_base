<?php

class Category extends Eloquent {

	protected $table = 'categories';
	protected $fillable = array('name', 'description', 'imageURL');

	public static $rules = array(
		'name'=>'required|min:5|max:255'
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}
}

?>