<?php

if( !function_exists('is_admin') ) 
{
	function is_admin()
	{
		if ( Auth::check() && Auth::user()->id == 1 )
		{
			return true; 
		}		

		return false;
	}
}

if( !function_exists('set_max_file_size') )
{
	function set_max_file_size($size)
	{
		ini_set('upload_max_filesize', $size);	
	}
		
} 