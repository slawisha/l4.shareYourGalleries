<?php namespace Petrovic\Gallery;

use Petrovic\Repositories\GalleryRepository as GalleryRepo;
use Petrovic\Repositories\ImageRepository as Image;
use Petrovic\Repositories\TagRepository as Tag;
use Petrovic\Repositories\ImageManipulationRepository as ImageManipulation;

class GalleryService {

	protected $gallery;
	protected $image;
	protected $tag;
	protected $imageManipulation;

	public function __construct(GalleryRepo $gallery, Image $image, Tag $tag, 
		ImageManipulation $imageManipulation)
	{
		$this->gallery = $gallery;
		$this->image = $image;
		$this->tag = $tag;
		$this->imageManipulation = $imageManipulation;
	}

	public function save($galleryName, $galleryDescription)
	{
		$input = [
				'name' => $galleryName, 
				'description' => $galleryDescription, 
				'user_id' => Auth::user()->id,
				'url' => Auth::user()->username . '/' . $galleryName . '/'
			];
		$galleryUrl = public_path() . '/gallery/' . Auth::user()->username . '/' . $galleryName . '/';

		$validationData = ['name'=>$galleryName];
		Event::fire('gallery.saving', [$validationData]);
		//makedir
		if(!file_exists($galleryUrl) && !empty($galleryUrl))
		File::makeDirectory($galleryUrl, 777, true, true);
		//save gallery
		$this->gallery->save($input);
	}

	public function uploadAndSaveImages($upload, $galleryName)
	{
		$galleryUrl = public_path() . '/gallery/' . Auth::user()->username . '/' . $galleryName . '/';
		$galleryId = $this->gallery->findLastUpdatedId();

		//save and move images
		$j = 1;

		foreach($upload as $image) 
		{
			if( !is_null($image) && $image->isValid() )
			{
				//dd($image);
				$imageUrl = time() . '-' . $image->getClientOriginalName();

				$image->move($galleryUrl , $imageUrl);
				$imagePath = $galleryUrl . '/' . $imageUrl;
				$imageFile = $this->imageManipulation->resizeImageFile($imagePath, 1024);
				$this->imageManipulation->saveImageFile($imageFile, $imagePath, 60);

				//save into db
				$this->image->save( ['url' => $imageUrl, 'gallery_id' => $galleryId, 'order'=>$j] );
				$j++;
			}
		}	
	}

	public function saveTags($galleryTagsString)
	{
		$galleryId = $this->gallery->findLastUpdatedId();
		$galleryTags = explode(',', $galleryTagsString);
		//save tags
		foreach ($galleryTags as $tag) {
			$this->tag->save( ['name' => $tag, 'gallery_id' => $galleryId] );
		}
	}
}