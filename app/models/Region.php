<?php
class Region extends Eloquent {

	protected $fillable = array('name', 'notes');

	public static $rules = array(
		'name'=>'required|min:5|max:255',
	);

	public static function validate($data) {
		return Validator::make($data, static::$rules);
	}

	public function venues() {
		return $this->hasMany('Venue', 'region_id', 'id');
	}

}
?>