<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  $oscTemplate->buildBlocks();

  if (!$oscTemplate->hasBlocks('boxes_column_left')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
  }

  if (!$oscTemplate->hasBlocks('boxes_column_right')) {
    $oscTemplate->setGridContentWidth($oscTemplate->getGridContentWidth() + $oscTemplate->getGridColumnWidth());
  }
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta charset="<?php echo CHARSET; ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo tep_output_string_protected($oscTemplate->getTitle()); ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
    <meta name="description" content="singa property, real property, phnom penh, real estate in cambodia, news ">
    <meta name="keywords" content="singa property, real property, phnom penh, real estate in cambodia, news ">
    <meta name="author" content="">
    <link rel="canonical" href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
    <meta NAME="robots" content="noindex, follow">
    <meta NAME="robots" content="index, nofollow">
    <meta NAME="robots" content="noindex, nofollow">
    <link rel="shortcut icon" href="images/banners/logo.ico">
    <link rel="shortcut icon" href="images/favicon.png">
    <link href="themes/libraries/bootstrap/bootstrap.min.css" rel="stylesheet"/>
    <linK href="themes/libraries/owl-carousel/owl.carousel.css" rel="stylesheet"/> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
    <linK href="themes/libraries/owl-carousel/owl.theme.css" rel="stylesheet"/> <!-- Core Owl Carousel CSS Theme  File  *	v1.3.3 -->
    <link href="themes/libraries/animate/animate.min.css" rel="stylesheet"/>
    <link href="themes/libraries/checkbox/minimal.css" rel="stylesheet"/>
    <link href="themes/libraries/drag-drop/drag-drop.css" rel="stylesheet"/>
    <link href="themes/css/components.css" rel="stylesheet"/>
    <link href="themes/style.css" rel="stylesheet"/>
    <link href="themes/css/media.css" rel="stylesheet"/>
<!--[if lt IE 9]>
   <script src="ext/js/html5shiv.js"></script>
   <script src="ext/js/respond.min.js"></script>
   <script src="ext/js/excanvas.min.js"></script>
<![endif]-->
    <link href='//fonts.googleapis.com/css?family=Khmer:400normal|Didact+Gothic:400normal|Open+Sans:400normal|Handlee:400normal|Lato:400normal|Lora:400normal|Roboto:400normal|Nunito:400normal|Montserrat:400normal|Hanuman:400normal|Raleway:400normal&subset=all' rel="stylesheet" type="text/css">
<script src="ext/jquery/jquery-1.11.1.min.js"></script>

<!-- font awesome -->
<link rel="stylesheet" href="ext/css/Font-Awesome-master/css/font-awesome.min.css">
    <meta name="csrf-param" content="authenticity_token" />
    <meta name="csrf-token" content="sNMk592JV2wwHn6DPJ8C5oy/hHDnjIlZBOHyngtTbpQ=" />
<?php //echo $oscTemplate->getBlocks('header_tags'); ?>
</head>
<body data-offset="200" data-spy="scroll" data-target=".primary-navigation">
  <?php echo $oscTemplate->getContent('navigation'); ?>
      <?php require(DIR_WS_INCLUDES . 'header.php'); 
        $url = $_SERVER['REQUEST_URI'];
          $fullUrl = end( (explode('/', $url)) );
          // check url if is index page
          if( strpos($fullUrl,'index.html') !== false || $fullUrl == '' ){
            $image_slider_query = tep_db_query("
                select
                  text, image
                from
                  image_slider
                where
                  image != ''
                    order by
                  sort_order asc limit 10
               ");
            if (tep_db_num_rows($image_slider_query) > 0) {

          include(DIR_WS_INCLUDES . 'slider.php');
        }}
      ?>
