<?php
class RestApiCroppedImage extends RestApi{	
	
	public function post( $params = array() ){
		
		$image = $params['POST']['data'];
		
		$uri =  substr($image,strpos($image,",")+1);
		
		// path image
		$imagePath = DIR_FS_CATALOG . 'images/clientimages/crop/';
		
		// create a filename for the new image		
		$file = md5(uniqid()) . '.jpg';		
		// create image thumbnail
		$imgThumbnail = DIR_FS_CATALOG . 'images/clientimages/crop/thumbnail/' . $file;
		
		// decode the image data and save it to file
		file_put_contents( $imagePath . $file, base64_decode($uri) );
		
		$this->make_thumb($imagePath . $file, $imgThumbnail, 500);
		
// 		var_dump( $imgThumbnail );
		// return the filename
		
		return array(
			'data' => $file
		);
	}
	
	function make_thumb($src, $dest, $desired_width) {
		/* read the source image */
		$source_image = imagecreatefrompng($src);
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