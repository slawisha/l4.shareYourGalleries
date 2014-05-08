<?php

use Petrovic\Repositories\UserRepository as User;
use Petrovic\Repositories\UserShareRepository as userShare;
use Petrovic\Repositories\GalleryRepository as Gallery;
use Petrovic\Repositories\TagRepository as Tag;

class PagesController extends \BaseController {

	protected $user;
	protected $userShare;
	protected $gallery;
	protected $tag;

	public function __construct(User $user, userShare $userShare, Gallery $gallery, Tag $tag)
	{
		$this->user = $user;
		$this->userShare = $userShare;
		$this->gallery = $gallery;
		$this->tag = $tag;
	}

	public function home()
	{
		return View::make('pages.home')->withTitle('Welcome');
	}

	public function register()
	{
		return View::make('pages.register')->withTitle('Register');
	}

	public function members()
	{
		$userShares = $this->user->userShares(Auth::user()->id);

		$userShareIds = $this->userShare->sharingIds(Auth::user()->id);

		//dd($userShareIds);

		$userShareGalleries = $this->user->findUserShareGalleries($userShareIds);

		$userShareGalleries = Paginator::make($userShareGalleries, count($userShareGalleries), 3);

		//$userShareGalleries = $paginator->getCollection();

		//dd($paginator->toArray());

		return View::make('pages.members')->withTitle('Members')
											->with('userShares', $userShares)
											->with('userShareGalleries', $userShareGalleries);
	}

	public function admin()
	{
		return View::make('pages.admin')->withTitle('Admin');
	}

	public function search()
	{
		$term = Input::get('search-term');
		
		$searchResults = $this->gallery->findByName($term);

		$userShareIds = $this->userShare->sharingIds(Auth::user()->id);

		return View::make('pages.search')->with('searchResults', $searchResults)
										->withTitle('Search results')
										->with('userShareIds', $userShareIds);
	}

	public function searchByTag($name)
	{
		$galleryIds = $this->tag->findGalleriesIdsByTagName($name);

		//dd($galleryIds);

		$searchResults = $this->gallery->findByIds($galleryIds);

		//dd($searchResults);

		$userShareIds = $this->userShare->sharingIds(Auth::user()->id);

		return View::make('pages.search')->with('searchResults', $searchResults)
										->withTitle('Search results')
										->with('userShareIds', $userShareIds);
	}

	public function searchGalleryByOwner($ownerId)
	{
		$searchResults = $this->user->findUsersGalleries($ownerId);

		$userShareIds = $this->userShare->sharingIds(Auth::user()->id);

		return View::make('pages.search')->with('searchResults', $searchResults)
										->withTitle('Search results')
										->with('userShareIds', $userShareIds);
	}

}