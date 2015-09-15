<?php

class Bookmark extends Eloquent {
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function getUrl() {
        $pattern = "/^(http(s?):\/\/)/";
        if (preg_match($pattern, $this->url)) {
            return $this->url;
        } else {
            return "http://".$this->url;
        }
    }
}