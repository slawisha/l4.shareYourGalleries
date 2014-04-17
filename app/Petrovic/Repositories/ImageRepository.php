<?php namespace Petrovic\Repositories;

use \Image;

class ImageRepository {

	public function save($input)
	{
		$image = new Image;

		foreach ($input as $key => $value) {
			$image->$key = $value;
		}
		
		$image->save();
	}

	public function findById($id)
	{
		return Image::find($id);
	}

	/**
	 * updates Order of images
	 * @param  array $orderArray 
	 * @return boolean   
	 */
	public function updateOrder($orderArray)
	{
		foreach ($orderArray as $orderItem) {

			$id = $orderItem[0];

			$order = $orderItem[1];
			
			$image = Image::find($id);

			$image->order = $order;

			$image->save();
		}
	}

	public function delete($id)
	{
		Image::find($id)->delete();
	}
}