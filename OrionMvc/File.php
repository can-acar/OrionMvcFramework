<?php

namespace OrionMvc;



/**
 * class PostedFile
 *
 * Description for class PostedFile
 *
 * @author:
*/
class File  {
	var $file, $name, $type, $size, $path, $error;
	/**
	 * PostedFile constructor
	 *
	 * @param 
	 */
	function File() {
		$this->file = &$f;
		$this->name = $f['name'];
		$this->type = $f['type'];
		$this->size = $f['size'];
		$this->path = $f['tmp_name'];
		$this->error = $f['error'];
		return $this;
	}
	
	/**
	 * PostedFile::hasError()
	 * 
	 * @return
	 */
	function hasError(){
		return $this->isUploaded() && $this->error != UPLOAD_ERR_OK;
	}

	/**
	 * PostedFile::isUploaded()
	 * 
	 * @return
	 */
	function isUploaded(){
		return $this->error != UPLOAD_ERR_NO_FILE;
	}

	/**
	 * PostedFile::save()
	 * 
	 * @param mixed $path
	 * @return
	 */
	function Save($path){
		return @move_uploaded_file($this->path, $path);
	}
}

?>