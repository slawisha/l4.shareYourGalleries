<?php

class Image extends \Eloquent {

    protected $protected = ['id'];

    public function gallery()
    {
    	return $this->belongsTo('Gallery');
    }
}