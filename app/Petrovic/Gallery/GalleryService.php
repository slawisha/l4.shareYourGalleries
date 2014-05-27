<?php namespace Petrovic\Gallery;

use Petrovic\Repositories\GalleryRepository as GalleryRepo;
use Petrovic\Repositories\ImageRepository as Image;
use Petrovic\Repositories\TagRepository as Tag;
use Petrovic\Repositories\ImageManipulationRepository as ImageManipulation;
use \Auth as Auth;
use \Event as Event;
use \File as File;

class GalleryService {

	protected $gallery;
	protected $image;
	protected $tag;
	protected $imageManipulation;


	public function __construct(GalleryRepo $gallery, Image $image, Tag $tag, ImageManipulation $imageManipulation)
	{
		$this->gallery = $gallery;
		$this->image = $image;
		$this->tag = $tag;
		$this->imageManipulation = $imageManipulation;
	}


	/**
	 * saves gallery into db and creates gallery folder
	 * @param  string $galleryName      
	 * @param  string $galleryDescription 
	 * @return void
	 */

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
		File::makeDirectory($galleryUrl, 0777, true, true);
		//save gallery
		$this->gallery->save($input);
	}


	/**
	 * pdate gallery
	 * @param  string $galleryName        
	 * @param  string $galleryDescription 
	 * @param  integer $id               
	 * @return void
	 */
	public function updateGallery($galleryName, $galleryDescription, $id)
	{
		$input = [
			'name' => $galleryName, 
			'description' => $galleryDescription, 
			'url' => $this->gallery->findById($id)->user->username . '/' . $galleryName . '/'
		];

		//update gallery
		$this->gallery->update($id, $input);
	}

	/**
	 * uploads and optimizes gallery images
	 * @param  array $upload
	 * @param  string $galleryUrl 
	 * @param  integer $galleryId  
	 * @param  integer $imageOrder 
	 * @return void             
	 */
	private function uploadImages($upload, $galleryUrl, $galleryId, $imageOrder)
	{

		foreach($upload as $image) 
		{
			if( !is_null($image) && $image->isValid() )
			{

				$imageUrl = time() . '-' . $image->getClientOriginalName();
				
				$imageFile = $this->imageManipulation->resizeImageFile($image->getRealPath(), 1024); //bigger size 1024px
				// $image->move($galleryUrl , $imageUrl);
				$imagePath = ($galleryUrl . '/' . $imageUrl);

				$this->imageManipulation->saveImageFile($imageFile, $imagePath, 60); //quality 60%

				$this->image->save( ['url' => $imageUrl, 'gallery_id' => $galleryId, 'order'=>$imageOrder] );
				$imageOrder++;
				
			}
		}	
	}

	/**
	 * uploads and saves gallery images to db
	 * @param  array $upload
	 * @param  string $galleryName
	 * @return void              
	 */
	public function uploadAndSaveImages($upload, $galleryName)
	{
		$galleryUrl = public_path() . '/gallery/' . Auth::user()->username . '/' . $galleryName;
		$galleryId = $this->gallery->findLastUpdatedId();

		//save and move images
		$imageOrder = 1;

		$this->uploadImages($upload, $galleryUrl, $galleryId, $imageOrder);
	}

	/**
	 * uploads and saves more gallery images to db
	 * @param  array $upload      
	 * @param  string $galleryName 
	 * @param  integer $id          
	 * @return void              
	 */
	public function uploadMoreImages($upload, $galleryName, $id)
	{
		$imageOrder = $this->gallery->countGalleryImages($id) + 1;
		$galleryUrl = public_path() . '/gallery/' . $this->gallery->findById($id)->user->username 
							. '/' . $galleryName . '/';
		$galleryId = $id;

		$this->uploadImages($upload, $galleryUrl, $galleryId, $imageOrder);
	}

	/**
	 * saves gallery tags
	 * @param  string $galleryTagsString 
	 * @param  integer $galleryId        
	 * @return void               
	 */
	public function saveTags($galleryTagsString, $galleryId = null)
	{
		if( is_null($galleryId) ) $galleryId = $this->gallery->findLastUpdatedId();
		if( !empty($galleryTagsString) ) 
		{
			$galleryTags = explode(',', $galleryTagsString);
			//save tags
			foreach ($galleryTags as $tag) {
				$this->tag->save( ['name' => $tag, 'gallery_id' => $galleryId] );
			}
		}
	}

	/**
	 * deletes gallery tags
	 * @param  integer $id 
	 * @return void     
	 */
	public function deleteTags($id)
	{
		$this->tag->delete($id);
	}

	/**
	 * renames gallery
	 * @param  string $galleryName
	 * @param  integer $id       
	 * @return void              
	 */
	public function renameGallery($galleryName, $id)
	{
		$validationData = ['name'=>$galleryName];
		Event::fire('gallery.saving', [$validationData]);

		$oldGalleryPath = public_path() . '/gallery/' . $this->gallery->findById($id)->url;
		$newGalleryPath = public_path() . '/gallery/' . $this->gallery->findById($id)->user->username . '/' . $galleryName;
		$this->gallery->renameGallery($oldGalleryPath, $newGalleryPath);
	}
}