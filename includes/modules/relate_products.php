<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/
    $new_products_query = tep_db_query("
      select
        p.products_id,
        p.products_price,
        p.products_image_thumbnail,
        p.products_image,
        pd.products_name
      from " . TABLE_PRODUCTS . " p
      left join  " . TABLE_PRODUCTS_DESCRIPTION . " pd
      on p.products_id = pd.products_id
      where p.products_status = '1'
      and p.products_id = pd.products_id
      and p.customers_id = '". $customer['customers_id'] ."'
      and pd.language_id = '" . (int)$languages_id . "'
      and p.products_id != '" . (int)$HTTP_GET_VARS['products_id'] . "'
      order by p.products_date_added desc limit 4");

  $num_new_products = tep_db_num_rows($new_products_query);

  if ($num_new_products > 0) {

    $new_prods_content = NULL;

    while ($new_products = tep_db_fetch_array($new_products_query)) {
      if (strlen($new_products['products_name']) > 50) {
        $p_name = substr($new_products['products_name'], 0, 45) . '...';
      }else{
        $p_name = $new_products['products_name'];
      }
      $new_prods_content .= '<div class="col-sm-4 col-md-3" style="padding-bottom: 10px;">';
      $new_prods_content .= '  <div class="productHolder equal-height" style="height: 208px;">';
      $new_prods_content .= '    <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">'
          . tep_image(DIR_WS_IMAGES . $new_products['products_image_thumbnail'],
              $new_products['products_name'], SMALL_IMAGE_WIDTH,
              SMALL_IMAGE_HEIGHT, 'style="width:170px;height:100px;"') . '</a>';
      $new_prods_content .= '    <div class="caption">';
      $new_prods_content .= '      <p class="text-center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO,
            'products_id=' . $new_products['products_id']) . '">'
            . $p_name . '</a></p>';
      $new_prods_content .= '      <p class="text-center price">' . $currencies->display_price($new_products['products_price'], tep_get_tax_rate($new_products['products_tax_class_id'])) . '</p>';
      $new_prods_content .= '    </div>';
      $new_prods_content .= '  </div>';
      $new_prods_content .= '</div>';
    }

?>
  <h4 class="page-header col-sm-12 col-md-12">Others Product</h4>
  <?php echo $new_prods_content; ?>
<?php
  }
?>
