<?php namespace Petrovic\Gallery\Facades;

use Illuminate\Support\Facades\Facade;

class Galleryfy extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Galleryfy';
	}
}