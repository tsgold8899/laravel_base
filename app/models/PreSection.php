<?php

class PreSection extends Eloquent {
    public function prelinks() {
        return $this->hasMany('PreLink');
    }
}