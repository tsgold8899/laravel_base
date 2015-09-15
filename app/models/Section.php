<?php

class Section extends Eloquent {
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function links() {
        return $this->hasMany('Link');
    }
    
    public function isMiscellaneous() {
        return ($this->name == '');
    }
    
    public function customizedName() {
        return $this->isMiscellaneous() ? "Miscellaneous" : $this->name;
    }
    
    public function hasMiscellaneous() {
        return ($this->where('name', '=', '')->count() > 0);
    }
}