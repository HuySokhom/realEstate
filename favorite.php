<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_REVIEWS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_REVIEWS));

  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<div class="margin-top">
<div class="container">
<?php
  $favorite_query_raw = "
    select
      f.id,
      SUBSTRING_INDEX(pd.products_description, ' ', 20)
        as
      products_description,
      p.products_id,
      pd.products_name,
      p.products_image,
      p.products_image_thumbnail
    from
      favorite f, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
    where
      p.products_status = '1'
        and
      p.products_id = f.products_id
        and
      p.products_id = pd.products_id
        and
      f.session_id = '" . $_SESSION['sessiontoken']. "'
        and
        pd.language_id = '" . (int)$languages_id . "'
      order by
        f.id DESC";
  $favorite_split = new splitPageResults($favorite_query_raw, MAX_DISPLAY_NEW_REVIEWS);

  if ($favorite_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>
<div class="row">
  <div class="col-sm-6 pagenumber hidden-xs">
    <?php echo $favorite_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
  </div>
  <div class="col-sm-6">
    <span class="pull-right pagenav"><ul class="pagination"><?php echo $favorite_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></ul></span>
    <span class="pull-right"><?php echo TEXT_RESULT_PAGE; ?></span>
  </div>
</div>
<?php
    }
    ?>
    <div class="contentText">
      <div class="reviews">
<?php
    $reviews_query = tep_db_query($favorite_split->sql_query);
    while ($reviews = tep_db_fetch_array($reviews_query)) {
      echo '<blockquote class="col-sm-6">';
      echo '  <p><span class="pull-left">' . tep_image(DIR_WS_IMAGES . tep_output_string_protected($reviews['products_image']), tep_output_string_protected($reviews['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</span>' . tep_output_string_protected($reviews['reviews_text']) . ' ... </p><div class="clearfix"></div>';
      $reviews_name = tep_output_string_protected($reviews['customers_name']);
      echo '  <footer>' . sprintf(REVIEWS_TEXT_RATED, tep_draw_stars($reviews['reviews_rating']), $reviews_name, $reviews_name) . ' <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, 'products_id=' . (int)$reviews['products_id']) . '"><span class="pull-right label label-info">' . REVIEWS_TEXT_READ_MORE . '</span></a></footer>';
      echo '</blockquote>';
    }
    ?>
      </div>
      <div class="clearfix"></div>
    </div>
<?php
  } else {
?>

  <div class="alert alert-info">
    <?php echo TEXT_NO_REVIEWS; ?>
  </div>

<?php
  }

  if (($favorite_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="row">
  <div class="col-sm-6 pagenumber hidden-xs">
    <?php echo $favorite_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
  </div>
  <div class="col-sm-6">
    <span class="pull-right pagenav"><ul class="pagination"><?php echo $favorite_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></ul></span>
    <span class="pull-right"><?php echo TEXT_RESULT_PAGE; ?></span>
  </div>
</div>
<?php
  }
?>
</div>
</div>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
