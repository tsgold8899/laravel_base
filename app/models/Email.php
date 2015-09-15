<?php

class Email extends Eloquent {

	protected $fillable = array('name', 'subject', 'content', 'notes');

	public static $rules = array(
		'name'=>'required|min:5|max:255',
		'subject'=>'required|min:5|max:255',
		'content'=>'required|min:10'
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}
}

?>