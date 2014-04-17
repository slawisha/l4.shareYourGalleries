<?php namespace Petrovic\Validation;

class GalleryValidator extends Validator{

	protected static $rules = [
		'name' => 'required|min:4',
		'images' => 'image|max:8'
	]; 
}