<?php

class PreLink extends Eloquent {
    public function presection() {
        return $this->belongsTo('PreSection');
    }
}