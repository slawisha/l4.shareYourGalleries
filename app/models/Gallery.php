<?php

class Gallery extends \Eloquent {

    protected $fillable = [];
    
    public function images()
    {
    	return $this->hasMany('Image');
    }

    public function user()
    {
    	return $this->belongsTo('User');
    }

    public function tags()
    {
    	return $this->hasMany('Tag');
    }
}