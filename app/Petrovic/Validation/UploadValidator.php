<?php namespace Petrovic\Validation;

use Illuminate\Support\MessageBag as MessageBag;

class UploadValidator{

	protected $errors;

	protected $allowedTypes = ['jpg', 'JPG', 'jpeg','JPEG', 'png', 'PNG', 'gif', 'GIF', 'bmp', 'BMP'];

	/**
	 * validate multiple Upload
	 * @param  array $upload
	 * @return bool
	 */
	public function validate($upload)
	{
		if( is_null($upload) )
		{
			$this->errors = new MessageBag(['images' => 'Upload exceeds maximum size of ' . ini_get('post_max_size')]);
			return false; 
		}

		foreach ($upload as $item)
		{
			if( ! empty($item)) 
			{
				if( ! $item->isValid() ) 
				{
					$this->errors = new MessageBag(['images' => $item->getErrorMessage()]);
					return false;
				}

				if( ! in_array($item->getClientOriginalExtension(), $this->allowedTypes)  )
				{
					$this->errors = new MessageBag(['images'=>"Unsupported file format. Upload only 'jpg', 'jpeg', 'png', 'gif', 'bmp' image formats."]);
					return false;
				}
			}
		}

		return true;
	}

	public function getErrors()
	{
		return $this->errors;
	}
}