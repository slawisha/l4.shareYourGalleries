<?php namespace Petrovic\Repositories;

use \ImageIntervention as Image;

class ImageManipulationRepository{

	public function resizeImageFile($uploadedImage, $widerDimension)
	{
		$image = Image::make($uploadedImage);

		if($image->width >= $image->height) 
		{
			if($image->width > $widerDimension)  
			{
				$image->resize($widerDimension, null, true);
			}
			else
			{
				$image->resize($image->width, null, true);
			}			
		} 
		else
		{
			if($image->height > $widerDimension)  
			{
				$image->resize(null, $widerDimension, true);
			}
			else
			{
				$image->resize(null, $image->height, true);
			}		
			
		}

		return $image;

	}

	public function saveImageFile($image, $path, $quality)
	{
		$image->save($path, $quality);

		 return true;
	}

}