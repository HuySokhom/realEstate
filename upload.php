<?php
require('includes/application_top.php');

if (!empty($_FILES)) {
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

//    $_FILES['file']['name'] = substr($_FILES['file']['name'], 0, strlen($ext) * -1)
//        . time()
//        . '.' . $ext;

    $tempFile = $_FILES['file']['tmp_name'];
    $targetPath = DIR_FS_CATALOG . 'images/site-images/' ;

    $targetFile =  $targetPath. $_FILES['file']['name'];

    move_uploaded_file($tempFile,$targetFile);
    return array(
        'data' => array(
            'image' =>  $_FILES['file']['name']
        )
    );
}
