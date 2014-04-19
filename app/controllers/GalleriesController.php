<?php

use Petrovic\Repositories\UserRepository as User;
use Petrovic\Repositories\GalleryRepository as Gallery;
use Petrovic\Repositories\ImageRepository as Image;
use Petrovic\Repositories\TagRepository as Tag;
use Petrovic\Repositories\ImageManipulationRepository as ImageManipulation;
use Petrovic\Validation\ValidationException;
use Petrovic\Validation\UploadValidator as UploadValidator;

class GalleriesController extends \BaseController {

	protected $user;
	protected $gallery;
	protected $image;
	protected $tag;
	protected $imageManipulation;
	protected $uploadValidator;

	public function __construct(User $user, Gallery $gallery, Image $image, Tag $tag, 
		ImageManipulation $imageManipulation, UploadValidator $UploadValidator)
	{
		$this->user = $user;
		$this->gallery = $gallery;
		$this->image = $image;
		$this->tag = $tag;
		$this->imageManipulation = $imageManipulation;
		$this->uploadValidator = $UploadValidator;
		$this->beforeFilter('auth');
		$this->beforeFilter('user',['except'=>['show','all']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($userId)
	{
		$galleries = $this->user->findUsersGalleries($userId);
		$userShares = $this->user->userShares($userId);
		//dd($galleries);
		return View::make('galleries.index')->withGalleries($galleries)
									->with('userShares', $userShares)
									->withTitle('Manage galleries')
									->with('userId',$userId);
	}

	public function all()
	{
		$galleries = $this->gallery->all();

		//dd($galleries);
		return View::make('galleries.all')->withGalleries($galleries)
									->withTitle('Manage galleries');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($userId)
	{
		$userShares = $this->user->userShares(Auth::user()->id);
		return View::make('galleries.create')
							->withTitle('Create gallery')
							->with('userShares', $userShares)
							->with('userId', Auth::user()->id);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($userId)
	{
		try{
			//dd(Input::file('images'));
			$galleryName = Input::get('gallery_name');
			$galleryDescription = Input::get('gallery_description');
			$galleryTags = Input::get('gallery_tags');
			$galleryUrl = public_path() . '/gallery/' . Auth::user()->username . '/' . $galleryName . '/';
			$galleryTags = explode(',', Input::get('gallery_tags'));

			// dd(Request::file('images'));

			$input = [
				'name' => $galleryName, 
				'description' => $galleryDescription, 
				'user_id' => Auth::user()->id,
				'url' => Auth::user()->username . '/' . $galleryName . '/'
			];

			//validate multiple upload
			if( $this->uploadValidator->validate(Request::file('images')) == false ) 
				return Redirect::back()->withInput()->withErrors( Session::put('error', $this->uploadValidator->getErrors()) );

			//validate rest of form
			$validationData = ['name'=>$galleryName];
			Event::fire('gallery.saving', [$validationData]);
			
			//makedir now
			if(!file_exists($galleryUrl) && !empty($galleryUrl))
			File::makeDirectory($galleryUrl, 777, true, true);
			
			//save gallery
			$this->gallery->save($input);

			$galleryId = $this->gallery->findLastUpdatedId();

			//save and move images
			$j = 1;

			//dd(Request::file('images'));
			foreach(Request::file('images') as $image) 
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
				//What if image is too large (Currently isn't saving)
			}

			//save tags
			foreach ($galleryTags as $tag) {
				$this->tag->save( ['name' => $tag, 'gallery_id' => $galleryId] );
			}

			return Redirect::route('users.galleries.index', ['userId'=>$userId])
						->withFlashMessage('Gallery created succesufuly');
		}

		catch(ValidationException $e )
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($userId, $id)
	{
		$gallery = $this->gallery->findById($id);
		$images = $this->gallery->findGalleryImages($id);
		$userShares = $this->user->userShares(Auth::user()->id);
		$galleryTags = $this->gallery->findGalleryTagsCollection($id);
		
		//dd($galleryTags);
		return View::make('galleries.show')->withTitle($gallery->name)
							->withGallery($gallery)
							->withImages($images)
							->with('userShares', $userShares)
							->with('galleryTags', $galleryTags);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($userId, $id)
	{
		$gallery = $this->gallery->findById($id);
		$images = $this->gallery->findGalleryImages($id);
		$userShares = $this->user->userShares(Auth::user()->id);
		$galleryTags = $this->gallery->findGalleryTags($id);
		//dd($images);
		return View::make('galleries.edit')->withTitle($gallery->name)->
							withGallery($gallery)
							->withImages($images)
							->with('userShares', $userShares)
							->with('galleryTags', $galleryTags);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($userId, $id)
	{
		try{
		//find old gallery name
		$oldGalleryPath = public_path() . '/gallery/' . $this->gallery->findById($id)->url;
		//rename and move images
		$galleryName = Input::get('gallery_name');

		//validate multiple upload
		if( $this->uploadValidator->validate(Request::file('images')) == false ) 
			return Redirect::back()->withInput()->withErrors( Session::put('error', $this->uploadValidator->getErrors()) );

		//validate rest of form
		$validationData = ['name'=>$galleryName];
		Event::fire('gallery.saving', [$validationData]);

		//rename gallery
		$newGalleryPath = public_path() . '/gallery/' . $this->gallery->findById($id)->user->username . '/' . $galleryName;
		$this->gallery->renameGallery($oldGalleryPath, $newGalleryPath);

		$galleryDescription = Input::get('gallery_description');
		$galleryTags = Input::get('gallery_tags');
		$galleryUrl = public_path() . '/gallery/' . $this->gallery->findById($id)->user->username . '/' . $galleryName . '/';
		$galleryTags = explode(',', Input::get('gallery_tags'));

		$input = [
			'name' => $galleryName, 
			'description' => $galleryDescription, 
			'url' => $this->gallery->findById($id)->user->username . '/' . $galleryName . '/'
		];

		//update gallery
		$this->gallery->update($id, $input);

		$imageOrder = $this->gallery->countGalleryImages($id) + 1;

		//save and move images

		foreach(Request::file('images') as $image) 
		{
			if( !is_null($image) && $image->isValid() )
			{
			$imageUrl = time() . '-' . $image->getClientOriginalName();
			$image->move($galleryUrl , $imageUrl);
			$imagePath = $galleryUrl . '/' . $imageUrl;
			$imageFile = $this->imageManipulation->resizeImageFile($imagePath, 1024);
			$this->imageManipulation->saveImageFile($imageFile, $imagePath, 60);

			$this->image->save( ['url' => $imageUrl, 'gallery_id' => $id, 'order' => $imageOrder] );
			$imageOrder++;
			}			
		}

		//delete old tags
		$this->tag->delete($id);

		//save new tags
		foreach ($galleryTags as $tag) {
			
			$this->tag->save( ['name' => $tag, 'gallery_id' => $id] );
		}

		if( is_admin() ) return Redirect::route('galleries.all')
				->withFlashMessage('Gallery updated succesufuly');

		return Redirect::route('users.galleries.index',['userId'=>$userId])
				->withFlashMessage('Gallery updated succesufuly');
		}

		catch(ValidationException $e )
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($userId, $id)
	{
		$oldGalleryPath = public_path() . '/gallery/' . $this->gallery->findById($id)->url;

		File::deleteDirectory($oldGalleryPath);

		$this->gallery->delete($id);

		return Redirect::route('users.galleries.index', ['userId'=>$userId])
				->withFlashMessage('Gallery deleted succesufuly');		
	}

}