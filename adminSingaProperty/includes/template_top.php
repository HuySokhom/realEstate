<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<link rel="shortcut icon" href="images/icons/ico.png">
<title><?php echo TITLE; ?></title>
<base href="<?php echo ($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_ADMIN : HTTP_SERVER . DIR_WS_ADMIN; ?>" />
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="css/theme-default.css">
<link rel="stylesheet" type="text/css" href="css/select2/select2.css">
  <link rel="stylesheet" type="text/css" href="css/select2/select.css">
  <link
      type="text/javascript"
      src="js/ng/lib/angular-clock/angular-clock.css"
  />
<link
    href='//fonts.googleapis.com/css?family=Khmer:400normal|Didact+Gothic:400normal|Open+Sans:400normal|Handlee:400normal|Lato:400normal|Lora:400normal|Roboto:400normal|Nunito:400normal|Montserrat:400normal|Hanuman:400normal|Raleway:400normal&subset=all'
    rel="stylesheet"
    type="text/css"
>
</head>
<body data-ng-app="main">
  <?php require(DIR_WS_INCLUDES . 'header.php'); ?>

