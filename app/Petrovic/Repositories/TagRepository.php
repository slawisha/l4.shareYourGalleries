<?php namespace Petrovic\Repositories;

use \Tag;

class TagRepository {

	public function findGalleriesIdsByTagName($name)
	{
		$results = [];
		$galleryIds = Tag::whereName($name)->lists('gallery_id');

		foreach ($galleryIds as $id) {
			if( !in_array($id, $results) )
			$results[] = $id;
		}

		return $results;
	}

	public function save($input)
	{
		$tag = new Tag;

		foreach ($input as $key => $value) {
			$tag->$key = trim($value);
		}

		$tag->save();

	}

	public function delete($id)
	{
		$tags = Tag::where('gallery_id','=', $id)->get();

		//dd($tags);

		foreach ($tags as $tag) {
			$tag->delete();
		}
	}

}