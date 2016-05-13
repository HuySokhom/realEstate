<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!isset($HTTP_GET_VARS['products_id'])) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_INFO);

  $product_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
  $product_check = tep_db_fetch_array($product_check_query);

  require(DIR_WS_INCLUDES . 'template_top.php');

  if ($product_check['total'] < 1) {
?>

<div class="contentContainer">
  <div class="contentText">
    <div class="alert alert-warning"><?php echo TEXT_PRODUCT_NOT_FOUND; ?></div>
  </div>

  <div class="pull-right">
    <?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon glyphicon-chevron-right', tep_href_link(FILENAME_DEFAULT)); ?>
  </div>
</div>

<?php
  } else {
    $product_info_query = tep_db_query("
        select p.products_id, p.products_image_thumbnail, pd.products_name, pd.products_description, p.products_model, p
        .products_quantity, pd.products_viewed, m.manufacturers_name, p.products_image, pd.products_url, p.products_price, p
        .products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id
        from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m
        where p.products_status = '1'
        and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'
        and pd.products_id = p.products_id
        and p.manufacturers_id = m.manufacturers_id
        and pd.language_id = '" . (int)$languages_id . "'
    ");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
      $products_price = '<del>' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</del> <span class="productSpecialPrice" itemprop="price">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
    } else {
      $products_price = '<span itemprop="price">' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
    }

    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
      $products_price .= '<link itemprop="availability" href="http://schema.org/PreOrder" />';
    } elseif ((STOCK_CHECK == 'true') && ($product_info['products_quantity'] < 1)) {
      $products_price .= '<link itemprop="availability" href="http://schema.org/OutOfStock" />';
    } else {
      $products_price .= '<link itemprop="availability" href="http://schema.org/InStock" />';
    }

    $products_price .= '<meta itemprop="priceCurrency" content="' . tep_output_string($currency) . '" />';

    $products_name = '<span itemprop="name" class="product_name">' . $product_info['products_name'] . '</span>';

    if (tep_not_null($product_info['products_model'])) {
      $products_name .= '<br /><small>[<span itemprop="model">' . $product_info['products_model'] . '</span>]</small>';
    }
?>

<?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')). 'action=add_product', 'NONSSL'), 'post', 'class="form-horizontal" role="form"'); ?>

<div itemscope itemtype="http://schema.org/Product">

<div class="page-header">
  <h1 class="pull-right product_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><?php echo $products_price;
  ?></h1>
  <h1><?php echo $products_name; ?></h1>
</div>

<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>
<link rel="stylesheet" href="ext/js/magnific-popup/magnific-popup.css">
<script src="ext/js/magnific-popup/jquery.magnific-popup.js"></script><script>
</script>
<div class="contentContainer">
  <div class="contentText">
<script type="text/javascript" src="ext/js/slider/jssor.slider.mini.js"></script>
    <!-- use jssor.slider.debug.js instead for debug -->
    <script type="text/javascript" src="ext/js/slide_product.js"></script>
    <link href="ext/css/slider_product.css" rel="stylesheet">
<?php
    if (tep_not_null($product_info['products_image'])) {

//      echo tep_image(DIR_WS_IMAGES . $product_info['products_image'], NULL, NULL, NULL, 'itemprop="image" style="display:none;"');
      $pi_query = tep_db_query("select image, image_thumbnail, htmlcontent from " . TABLE_PRODUCTS_IMAGES . " where
      products_id = '" . (int)$product_info['products_id'] . "'order by sort_order");
      $pi_total = tep_db_num_rows($pi_query);
      ?>
      <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 800px; height: 456px;
       overflow: hidden; visibility: hidden; background-color: #24262e;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('images/product_slider/loading.gif') no-repeat center center;
            top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div class="gallery"  data-u="slides"
            style="
                cursor: default; position: relative;
                top: 0px; left: 0px; width:800px;
                height: 356px; overflow: hidden;"
            >
          <div data-p="144.50" style="display: none;">
            <a href="<?php echo DIR_WS_IMAGES . $product_info['products_image'];?>">
                <img data-u="image" src="<?php echo DIR_WS_IMAGES . $product_info['products_image'];?>" />
            </a>
            <img data-u="thumb" src="<?php echo DIR_WS_IMAGES . $product_info['products_image_thumbnail'];?>" />
          </div>
          <?php
            if ($pi_total > 0) {
                while ($pi = tep_db_fetch_array($pi_query)) {
                    echo '<div data-p="144.50" style="display: none;">';
                    echo '<a href="'. DIR_WS_IMAGES . $pi['image'] .'"><img data-u="image" src="' . DIR_WS_IMAGES . $pi['image'] . '" /></a>';
                    echo '<img data-u="thumb" src="' . DIR_WS_IMAGES . $pi['image_thumbnail'] . '" />';
                    echo '</div>';
                }
            }
        ?>
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort01" style="position:absolute;left:0px;bottom:0px;width:800px;height:100px;" data-autocenter="1">
            <!-- Thumbnail Item Skin Begin -->
            <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                    <div class="w">
                        <div data-u="thumbnailtemplate" class="t"></div>
                    </div>
                    <div class="c"></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora05l" style="top:158px;left:8px;width:40px;height:40px;"></span>
        <span data-u="arrowright" class="jssora05r" style="top:158px;right:8px;width:40px;height:40px;"></span>
        <a href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
    </div>
<?php
    }
?>
<div class="col-md-12">
    <table style="width: 100%; margin-top: 10px;">
        <tr>
            <td width="35%">
                <?php echo '<b>Post Date:</b> ' . date('d-F-Y', strtotime($product_info['products_date_added'])); ?>
            </td>
            <td>
                <?php echo '<b>Kind Of:</b> ' . $product_info['manufacturers_name']; ?>
            </td>
            <td>
                <?php echo '<b>View:</b> ' . $product_info['products_viewed']; ?>
            </td>
        </tr>
    </table>
</div>
<div class="col-sm-8 col-md-8">
    <h4 class="page-header">Description:</h4>
    <div itemprop="description">
      <?php echo stripslashes($product_info['products_description']); ?>
    </div>
</div>
<div class="col-sm-4 col-md-4">
    <h4 class="page-header">Contact:</h4>
    <?php
        $customer_query = tep_db_query("
          select contact_name, contact_phone, contact_address, contact_email, customers_id
          from product_contact_person
          where
            products_id = ". (int)$HTTP_GET_VARS['products_id'] . "
        ");
        $customer = tep_db_fetch_array($customer_query);
        if (tep_db_num_rows($customer_query) > 0) {
            echo '<table>';
            echo '<tr><td><span class="glyphicon glyphicon-user icon-font"></span>' . $customer['contact_name'] . '</td></tr>';
            echo '<tr><td><span class="glyphicon glyphicon-phone icon-font"></span>' . $customer['contact_phone'] . '</td></tr>';
            echo '<tr><td><span class="glyphicon glyphicon-globe icon-font"></span>' . $customer['contact_address'] . '</td></tr>';
            echo '<tr><td><span class="glyphicon glyphicon-envelope icon-font"></span>' . $customer['contact_email'] . '</td></tr>';
            echo '<tr><td><span class="glyphicon glyphicon-home icon-font"></span>
                <a href="user.php?id='. $customer['customers_id'] .'">Go To Store</a></td></tr>';
            echo '</table>';
        }
    ?>
</div>

 <div class="clearfix col-sm-12 col-md-12 alert alert-success">
    <p>
        ទំនាក់ទំនងលេខ <?php echo $customer['contact_phone'];?> កុំភ្លេចនិយាយថាអ្នកបានរកឃើញការផ្សព្វផ្សាយនេះនៅលើ
        <?php echo STORE_NAME;?>។
   </p>
    <p>
        Call to <?php echo $customer['contact_phone'];?> for more information,
        don't forget to mention that you found this ad on <?php echo STORE_NAME;?>.
    </p>
</div>
<?php
    include(DIR_WS_MODULES . 'relate_products.php');
?>
<?php
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
?>

    <h4><?php echo TEXT_PRODUCT_OPTIONS; ?></h4>

    <p>
<?php
      $products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$HTTP_GET_VARS['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if (is_string($HTTP_GET_VARS['products_id']) && isset($cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']])) {
          $selected_attribute = $cart->contents[$HTTP_GET_VARS['products_id']]['attributes'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
?>
      <strong><?php echo $products_options_name['products_options_name'] . ':'; ?></strong><br /><?php echo tep_draw_pull_down_menu('id[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute, 'style="width: 200px;"'); ?><br />
<?php
      }
?>
    </p>

<?php
    }
?>

    <div class="clearfix"></div>

<?php
    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
?>

    <div class="alert alert-info"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?></div>

<?php
    }
?>

  </div>

<?php
    $reviews_query = tep_db_query("select count(*) as count, avg(reviews_rating) as avgrating from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and reviews_status = 1");
    $reviews = tep_db_fetch_array($reviews_query);

    if ($reviews['count'] > 0) {
      echo '<span itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating"><meta itemprop="ratingValue" content="' . $reviews['avgrating'] . '" /><meta itemprop="ratingCount" content="' . $reviews['count'] . '" /></span>';
    }
?>

  <div class="buttonSet row" style="display: none;">
    <div class="col-xs-6"><?php echo tep_draw_button(IMAGE_BUTTON_REVIEWS . (($reviews['count'] > 0) ? ' (' . $reviews['count'] . ')' : ''), 'glyphicon glyphicon-comment', tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params())); ?></div>
    <div class="col-xs-6 text-right"><?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_draw_button(IMAGE_BUTTON_IN_CART, 'glyphicon glyphicon-shopping-cart', null, 'primary', null, 'btn-success'); ?></div>
  </div>

  <div class="row">
    <?php echo $oscTemplate->getContent('product_info'); ?>
  </div>

<?php
    if ((USE_CACHE == 'true') && empty($SID)) {
      echo tep_cache_also_purchased(3600);
    } else {
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }

    if ($product_info['manufacturers_id'] > 0) {
      $manufacturer_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$product_info['manufacturers_id'] . "'");
      if (tep_db_num_rows($manufacturer_query)) {
        $manufacturer = tep_db_fetch_array($manufacturer_query);
        echo '<span itemprop="manufacturer" itemscope itemtype="http://schema.org/Organization"><meta itemprop="name" content="' . tep_output_string($manufacturer['manufacturers_name']) . '" /></span>';
      }
    }
?>

</div>

</div>
</form>
<script>
$('.gallery').each(function() { // the containers for all your galleries
    $(this).magnificPopup({
        delegate: 'a', // the selector for gallery item
        type: 'image',
        gallery: {
          enabled:true
        }
    });
});

//    $(function() {
//        $( "#columnLeft" ).css('display', 'none');
//        $( "#bodyContent" ).removeClass('col-md-9 col-md-push-3');
//        $( "#bodyContent" ).addClass('col-md-12');
//    });
</script>
<?php
  }
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
