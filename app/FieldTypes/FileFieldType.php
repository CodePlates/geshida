<?php 

namespace App\FieldTypes;

/**
 * 
 */
abstract class FileFieldType extends FieldType 
{
	
	protected $filePath;

	public function filePath($path)
	{
		$this->filePath = $path;
	}

	protected function saveToFilesystem($file, $disk = 'public')
	{
		$path = $file->store($this->filePath, $disk);
		return $path;
	}

	public function saveAction($model, $value)
	{
		$path = $this->saveToFilesystem($value);
		$model->{$this->getName()} = $path;
	}
}