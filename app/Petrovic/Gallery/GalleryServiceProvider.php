<?php namespace Petrovic\Gallery;

use Illuminate\Support\ServiceProvider;

class GalleryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider
     * 			
     * @return void 
     */
	public function register()
	{
		$this->app->bind('Gallery', 'Petrovic\Gallery\GalleryService');
	}
}