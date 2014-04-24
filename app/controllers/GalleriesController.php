<?php

use Petrovic\Repositories\UserRepository as User;
use Petrovic\Repositories\GalleryRepository as GalleryRepo;
use Petrovic\Validation\ValidationException;
use Petrovic\Validation\UploadValidator as UploadValidator;
use Petrovic\Validation\UploadValidationException as UploadValidationException;

class GalleriesController extends \BaseController {

	protected $user;
	protected $gallery;
	protected $uploadValidator;

	public function __construct(User $user, GalleryRepo $gallery, UploadValidator $UploadValidator)
	{
		$this->user = $user;
		$this->gallery = $gallery;
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
			//validate multiple upload
			if( ! $this->uploadValidator->validate(Request::file('images')) ) 
				throw new UploadValidationException($this->uploadValidator->getErrors());

			Galleryfy::save(Input::get('gallery_name'), Input::get('gallery_description'));
			
			Galleryfy::uploadAndSaveImages(Input::file('images'), Input::get('gallery_name'));

			Galleryfy::saveTags(Input::get('gallery_tags'));

			return Redirect::route('users.galleries.index', ['userId'=>$userId])
						->withFlashMessage('Gallery created succesufuly');
		}

		catch(UploadValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
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
		//validate multiple upload
		if( $this->uploadValidator->validate(Request::file('images')) == false ) 
			throw new UploadValidationException($this->uploadValidator->getErrors());

		Galleryfy::renameGallery(Input::get('gallery_name'), $id);

		Galleryfy::updateGallery(Input::get('gallery_name'), Input::get('description'), $id);

		Galleryfy::uploadMoreImages(Input::file('images'), Input::get('gallery_name'), $id);

		Galleryfy::deleteTags($id);

		Galleryfy::saveTags(Input::get('gallery_tags'), $id);

		if( is_admin() ) return Redirect::route('galleries.all')
				->withFlashMessage('Gallery updated succesufuly');

		return Redirect::route('users.galleries.index',['userId'=>$userId])
				->withFlashMessage('Gallery updated succesufuly');
		}

		catch(UploadValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
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