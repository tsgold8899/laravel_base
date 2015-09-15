<?php
class Venue extends Eloquent {
	
	protected $fillable = array('name', 'address', 'notes', 'region_id');

	public static $rules = array(
		'name'=>'required|min:5|max:255',
		'address'=>'required|min:10|max:255'
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}

	public function region() {
		return $this->hasOne('Region', 'id', 'region_id');
	}
}
?>