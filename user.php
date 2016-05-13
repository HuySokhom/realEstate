<?php
require('includes/application_top.php');

if (!isset($HTTP_GET_VARS['id'])) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
$product_check_query = tep_db_query("
  select pd.products_name, pd.products_description, p.products_image_thumbnail, p.products_price, pd.products_viewed
  from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
  where p.products_status = '1' and p.customers_id = '" . (int)$HTTP_GET_VARS['id'] . "'
    and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
//$product_check = tep_db_fetch_array($product_check_query);
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_USER);
$breadcrumb->add(NAVBAR_TITLE, tep_href_link('user.php', '', 'SSL'));
require(DIR_WS_INCLUDES . 'template_top.php');
?>
<div class="page-header">
    <h1><?php echo HEADING_TITLE;
        $num_of_products = tep_db_num_rows($product_check_query);

        if ($num_of_products > 0) {
            while ($product_check = tep_db_fetch_array($product_check_query)) {
                var_dump($product_check);
            }
        }else{
            echo '<div class="alert alert-warning">No Products</div>';
        }
        ?>
    </h1>
</div>




<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>


