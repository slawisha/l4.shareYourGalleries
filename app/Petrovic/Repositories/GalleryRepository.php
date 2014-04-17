<?php namespace Petrovic\Repositories;

use \Gallery;

class GalleryRepository {

	/**
	 * find all galleries
	 * @return Collection 
	 */
	public function all()
	{
		return Gallery::with('user')->get();
	}

	/**
	 * find gallery with specific id
	 * @param  int $id 
	 * @return Collection 
	 */
	public function findById($id)
	{
		return Gallery::with('user')->find($id);
	}

	/**
	 * finds galleries with specific id's
	 * @param  array $ids 
	 * @return Collection
	 */
	public function findByIds($ids)
	{
		return Gallery::whereIn('id', $ids)->get();
	}

	/**
	 * find gallery by name
	 * @param  string $name 
	 * @return Collection
	 */
	public function findByName($name)
	{
		return Gallery::where('name', 'LIKE', '%' . $name . '%')->get();
	}

	/**
	 * saves gallery into database
	 * @param  array $input 
	 */
	public function save($input)
	{
		$gallery = new Gallery;

		foreach ($input as $key => $value) {
			$gallery->$key = $value;
		}

		$gallery->save();

	}

	/**
	 * updates gallery with specific id into database
	 * @param  int $id 
	 * @param  array $input 
	 */
	public function update($id, $input)
	{
		$gallery = Gallery::find($id);

		foreach ($input as $key => $value) {
			$gallery->$key = $value;
		}

		$gallery->save();
	}

	/**
	 * deletes gallery with specific id from the database
	 * @param int $id 
	 */
	public function delete($id)
	{
		Gallery::find($id)->delete();
	}

	/**
	 * gets the id of the last addedGallery
	 * @return int 
	 */
	public function findLastUpdatedId()
	{
		$lastGallery = Gallery::orderBy('updated_at', 'desc')->first();
		return $lastGallery->id;
	}

	/**
	 * return all images that bellongs to gallery with specific id
	 * @param  int $id gallery id
	 * @return Collection 
	 */
	public function findGalleryImages($id)
	{
		return Gallery::find($id)->images()->orderBy('order')->get();
	}

	public function countGalleryImages($id)
	{
		return Gallery::find($id)->images->count();
	}

	/**
	 * finds gallery tags as string
	 * @param  int $id gallery id
	 * @return string  
	 */
	public function findGalleryTags($id)
	{
		$galleryTags = Gallery::find($id)->tags;
		$galleryTagsArray =[];

		foreach ($galleryTags as $tag) {
			$galleryTagsArray[] = $tag->name;
		}

		$galleryTagsString = implode(',', $galleryTagsArray);

		return $galleryTagsString;
	}

	/**
	 * [findGalleryTagsCollection description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function findGalleryTagsCollection($id)
	{
		return Gallery::find($id)->tags; 
	}

	/**
	 * rename gallery
	 * @param  string $oldName 
	 * @param  string $newName 
	 * @return string
	 */
	public function renameGallery($oldName, $newName)
	{
		if($newName != $oldName) rename($oldName, $newName);
		return $newName;
	}
}
