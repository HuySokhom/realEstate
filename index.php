<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $categories_products = tep_db_fetch_array($categories_products_query);
    if ($categories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);

  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<?php
 if ($category_depth == 'products' || (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id']))) {

    /******************************************************************************************/
    /********************** Optional Product Filter by Categories *****************************/
    /******************************************************************************************/

    $listing_sql = "
      select
          p.products_image,
          pd.products_name,
          pd.products_viewed,
          p.products_image_thumbnail,
          p.products_id,
          p.products_promote,
          SUBSTRING_INDEX(pd.products_description, ' ', 20) as products_description,
          p.products_price
      from
          products_description pd, products p
      where
          p.products_status = 1
              and
          pd.products_id = p.products_id
              and
          pd.language_id = " . (int)$languages_id . "
              and
          p.categories_id = '" . (int)$current_category_id . "'
      ORDER BY
          p.products_promote DESC,
          p.products_date_added DESC
      ";

?>
<div class="margin-top">

<?php

    include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
?>

</div>

<?php
  } else {

    /****************************************************************/
    /********************** default page ****************************/
    /****************************************************************/
?>

<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>

<!-- Search Section -->
<?php
  include('advanced_search_box.php');
?>
<!-- Search Section /- -->

<div class="container">
<?php
    if (tep_not_null(TEXT_MAIN)) {
?>

  <div class="contentText">
    <?php echo TEXT_MAIN; ?>
  </div>

<?php
    }

    include(DIR_WS_MODULES . FILENAME_RENT_PRODUCTS);
    include(DIR_WS_MODULES . FILENAME_SALE_PRODUCTS);
    include(DIR_WS_MODULES . FILENAME_BOTH_PRODUCTS);
?>
</div>
<?php
  }

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
