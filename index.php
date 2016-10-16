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
          p.bed_rooms,
          p.bath_rooms,
          p.number_of_floors,
          p.products_id,
          p.products_promote,
          SUBSTRING_INDEX(pd.products_description, ' ', 20) as products_description,
          p.products_price,
          c.photo_thumbnail as company_logo
      from
          products_description pd, products p, customers c
      where
          p.products_status = 1
              and
          c.customers_id = p.customers_id
              and
          pd.products_id = p.products_id
              and
          pd.language_id = " . (int)$languages_id . "
              and
          p.categories_id = '" . (int)$current_category_id . "'
      ORDER BY
          p.products_promote DESC, rand(),
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

<div class="container" style="margin-top: 20px;">
<?php
    if (tep_not_null(TEXT_MAIN)) {
?>

  <div class="contentText">
    <?php echo TEXT_MAIN; ?>
  </div>

<?php
    }
?>
<div class="col-md-2" style="text-align: center;">
<?php include('advertisement_left.php');?>
</div>
<div class="row col-md-8">
<?php
    include(DIR_WS_MODULES . FILENAME_HOME_PRODUCTS);
    // query banners
    $banner_query = tep_db_query("
      select
        title, link, image_thumbnail
      from
        banner_partner
      where 
        status = 1
      order by sort_order asc      
    ");
    $partner_array = [];
    while ($item = tep_db_fetch_array($banner_query)) {
      $partner_array[] = $item;
    }
?>
</div>
<div class="col-md-2" style="text-align: center;">
<?php include('advertisement_right.php');?>
</div>

    <div class="clearfix"></div>
    <div class="col-md-12">
    <?php
        include(DIR_WS_MODULES . FILENAME_NEWS);
    ?>
    <h3 style="border-bottom: 2px solid #333;"><?php echo OUR_PARTNERS;?></h3>
      <!-- Partner Section -->
      <div id="partner-section" class="partner-section">
        <div class="row">
          <div id="business-partner" class="business-partner">
            <?php
              foreach ($partner_array as $obj) {
                echo '
                  <div class="item">
                    <a title="' . $obj['title'] . '" href="http://' . $obj['link'] . '" target="_blank">
                      <img src="images/' . $obj['image_thumbnail'] . '" />
                    </a>
                  </div>
                ';
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Partner Section /- -->
</div>
<?php
  }

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
