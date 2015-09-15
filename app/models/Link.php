<?php

class Link extends Eloquent {
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function section() {
        return $this->belongsTo('Section');
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