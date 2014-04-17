<?php

use Petrovic\Repositories\ImageRepository as Image;
use Petrovic\Repositories\GalleryRepository as Gallery;

class ImagesController extends \BaseController {

	protected $image;
	protected $gallery;

	public function __construct(Image $image, Gallery $gallery)
	{
		$this->image = $image;
		$this->gallery = $gallery;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function sortImages()
	{
		if( Request::ajax() )
		{
			$orderArray = Input::get('order_array');

			array_shift($orderArray);

			$this->image->updateOrder($orderArray);

			echo(json_encode($orderArray));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if( Request::ajax() ) 
		{
			$id = Input::get('image_id');

			$nextImages = Input::get('next_images'); 

			$image = $this->image->findById($id);

			$gallery = $image->gallery;			
			
			$imagePath = 'gallery/' . $gallery->url . $image->url;
			
			File::delete($imagePath);

			$this->image->delete($id);

			$this->image->updateOrder($nextImages);
			
			echo(json_encode($nextImages));
			
		}
	}

}