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
  <div class="col-sm-8 col-md-9">
    <div class="reviews">
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
      p.products_image_thumbnail,
      p.bed_rooms,
      p.bath_rooms,
      p.number_of_floors,
      p.products_price,
      p.products_promote
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
  $favorite_split = new splitPageResults($favorite_query_raw, 12);

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
<?php
    $reviews_query = tep_db_query($favorite_split->sql_query);
    while ($reviews = tep_db_fetch_array($reviews_query)) {
      switch ($reviews['products_promote']) {
        case 3:
          $text = 'Pro Featured';
          $class = 'pro';
          break;
        case 2:
          $text = 'Premium Featured';
          $class = 'premium';
          break;
        case 1:
          $text = 'Basic Featured';
          $class = 'basic';
          break;
        default:
          $text = 'Free';
          $class = 'free';
      }
      echo '
         <div class="item">
          <!-- col-md-12 -->
          <div class="col-md-4 col-sm-6 col-sm-8 col-home rent-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a
                    title="Property Image"
                    href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $reviews['products_id']) . '"
                >
                  '
                      . tep_image(DIR_WS_IMAGES . $reviews['products_image_thumbnail'],
                      $reviews['products_name'], SMALL_IMAGE_WIDTH,
                      SMALL_IMAGE_HEIGHT, 'style="width:100%; height: 200px;"') .
                  '
                </a>
                <div class="' . $class . '">'. $text .'</div>
                <h4>
                    ' . $currencies->display_price($reviews['products_price'], tep_get_tax_rate($reviews['products_tax_class_id'])) . '
                </h4>
                <div class="' . $class . '">'. $text .'</div>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="'.tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $reviews['products_id']).'">' . $reviews['products_name'] . '</a>
                <ul>
                  <li>
                      <i class="fa fa fa-institution"></i>
                      ' . $reviews['number_of_floors'] . '
                  </li>
                  <li>
                    <i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>
                    '. $reviews['bed_rooms'] .'
                  </li>
                  <li>
                    <i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>
                    '. $reviews['bath_rooms'] . '
                  </li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div><!-- col-md-12 /- -->
       </div>
      ';
    }
    ?>
      <div class="clearfix"></div>
      <?php
      if (($favorite_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
        ?>
        <div class="row">
          <div class="col-sm-6 pagenumber hidden-xs">
            <?php //echo $favorite_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?>
          </div>
          <div class="pull-right" style="margin-right: 21px;">
            <span class="listing-pagination">
              <ul class="pagination">
                <?php echo $favorite_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?>
              </ul>
            </span>
          </div>
        </div>
        <?php
      }
      ?>
    <?php
  } else {
?>

  <div class="alert alert-info">
    <?php echo TEXT_NO_REVIEWS; ?>
  </div>

<?php
  }
?>

    </div>
  </div>
  <?php include('advanced_search_box_right.php');?>
</div>
</div>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
