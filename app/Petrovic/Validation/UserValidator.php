<?php namespace Petrovic\Validation;

class UserValidator extends Validator{

	protected static $rules = [
		'username' => 'required|min:4',
		'email' => 'required|email',
		'password' => 'required|confirmed',
	]; 
}