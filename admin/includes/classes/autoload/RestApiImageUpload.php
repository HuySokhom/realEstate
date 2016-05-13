<?php

class RestApiImageUpload extends RestApi {

	public function post( $params = array() ){
		foreach ( $_FILES as $file ){

			// get extension
			$ext = pathinfo($file['name'], PATHINFO_EXTENSION);

			// check extension is valid image
			if( ! in_array($ext, array(
				'jpg',
				'jpeg',
				'gif',
				'png',
			))){
				continue;
			}

			// add timestamp to image name to prevent against overwrites
			$file['name'] = substr($file['name'], 0, strlen($ext) * -1)
				. time()
				. '.' . $ext
			;
			if(move_uploaded_file(
				$file['tmp_name'],
				DIR_FS_CATALOG . 'images/' . $file['name']
			)){
				$image = DIR_FS_CATALOG . 'images/' . $file['name'];
				// to make image thumbnail
				$imgThumbnail = DIR_FS_CATALOG . 'images/image-thumbnail/' . $file['name'];
				$this->make_thumb($file, $image, $imgThumbnail, 100);
			}
			return array(
				'data' => array(
					'image' => $file['name'],
					'image_thumbnail' => 'image-thumbnail/' . $file['name']
				)
			);
		}

	}

	function make_thumb($file, $src, $dest, $desired_width) {
		/* read the source image */
		if( $file['type'] == 'image/jpeg' ){
			$source_image = imagecreatefromjpeg($src);
		}else{
			$source_image = imagecreatefrompng($src);
		}
		$width = imagesx($source_image);
		$height = imagesy($source_image);

		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));

		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest);
	}
	
}