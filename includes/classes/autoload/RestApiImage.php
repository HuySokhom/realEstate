<?php

class RestApiImage extends RestApi {

	public function post( $params ){		
		foreach( $_FILES as $file ){				
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
				. '.png'
			;
				
			if(move_uploaded_file(
				$file['tmp_name'],
				DIR_FS_CATALOG.'images/site-images/' . $file['name']
			)){
				$filename = DIR_FS_CATALOG . 'images/site-images/' . $file['name'];
				/** 
				 * convert image type to PNG to support on frontend
				 * when generate pdf file with image
				 */ 
				imagepng( imagecreatefromstring( file_get_contents($filename) ), "output.png");
				$output = DIR_FS_ADMIN . 'api/output.png';
				// move file image from to correct folder
				rename( $output, $filename );				
			}
			
			return array(
				'data' => $file['name']
			);			
		}
	}
	
}