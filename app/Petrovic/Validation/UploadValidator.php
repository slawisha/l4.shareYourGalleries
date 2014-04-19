<?php namespace Petrovic\Validation;


class UploadValidator{

	protected $errors;

	protected $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

	/**
	 * validate multiple Upload
	 * @param  array $upload
	 * @return bool
	 */
	public function validate($upload)
	{
		if( is_null($upload) )
		{
			$this->errors = 'Upload exceeds maximum size of ' . ini_get('post_max_size');
			return false; 
		}

		foreach ($upload as $item)
		{
			if( ! empty($item)) 
			{
				if( ! $item->isValid() ) 
				{
					$this->errors = $item->getErrorMessage();
					return false;
				}

				if( ! in_array($item->getClientMimeType(), $this->allowedTypes)  )
				{
					$this->errors = "Unsupported file format. 
						Upload only 'jpg', 'jpeg', 'png', 'gif', 'bmp' image formats.";
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