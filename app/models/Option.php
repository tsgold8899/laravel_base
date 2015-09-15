<?php

class Option extends Eloquent {
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function getValue() {
        if ($this->id > 0) {
            return $this->value;
        } else {
            return Config::get('option.'.$key);
        }
    }
}