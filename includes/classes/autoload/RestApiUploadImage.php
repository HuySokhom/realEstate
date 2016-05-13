<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 11/13/15
 * Time: 6:41 PM
 */
class RestApiUploadImage extends RestApi {

    public function get(){
        if ( !isset($_SESSION['user_name']) ) {
            throw new \Exception(
                "403: Access Denied",
                403
            );
        } else {
            return array(data => array('user_name' => $_SESSION['user_name']));
        }
    }

    public function post( $params ){
        if ( !isset($_SESSION['user_name']) ) {
            throw new \Exception(
                "403: Access Denied",
                403
            );
        } else {
            foreach ($_FILES as $file) {
                // get extension
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

                // check extension is valid image
                if (!in_array($ext, array(
                    'jpg',
                    'jpeg',
                    'gif',
                    'png',
                ))
                ) {
                    continue;
                }
                $user = str_replace(' ', '_', $_SESSION['user_name']);
                // add timestamp to image name to prevent against overwrites
                $file['name'] = substr($file['name'], 0, strlen($ext) * -1)
                    . time()
                    . '.' . $ext;

                // create folder for each user when upload
                $folderName = DIR_FS_CATALOG . 'images/' . $user;

                if ( !file_exists($folderName) ) {
                    mkdir( $folderName , 0777, true);
                }

                $date = new DateTime();
                $dateUpload =  date_format($date, 'Y-m-d');
                // create sub folder
                $folderDate = $folderName . '/' . $dateUpload;
                if(!file_exists($folderDate)){
                    // create date folder in each folder in user folder upload file
                    // to determine how many file per day when user upload
                    mkdir( $folderDate , 0777, true);
                }

                $folderImage = $folderDate . '/images/';
                if(!file_exists($folderImage)){
                    // create date folder in each folder in user folder upload file
                    // to determine how many file per day when user upload
                    mkdir( $folderImage , 0777, true);
                }
                $folderImageThumbnail = $folderDate . '/image_thumbnail/';
                if(!file_exists($folderImageThumbnail)){
                    // create date folder in each folder in user folder upload file
                    // to determine how many file per day when user upload
                    mkdir( $folderImageThumbnail , 0777, true);
                }

                // count file in folder
//                $fileCount = new FilesystemIterator($folderDate, FilesystemIterator::SKIP_DOTS);
//                $totalFile = iterator_count($fileCount);
                // check limit for security when upload file
//                if($totalFile < 50) {
                    if (move_uploaded_file(
                        $file['tmp_name'],
                        $folderImage . $file['name']
                    )) {
                        $imgOriginal = $folderImage . $file['name'];
                        $imgThumbnail = $folderImageThumbnail . $file['name'];

                        $this->make_thumb($file, $imgOriginal, $imgThumbnail, 120);
                    }

                    return array(
                        'data' => array(
                            'image' => $user . '/' . $dateUpload . '/images/'. $file['name'],
                            'image_thumbnail' => $user . '/' . $dateUpload .'/image_thumbnail/' . $file['name']
                        )
                    );
//                }
            }
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