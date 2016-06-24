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

?>
<div class="container">

<?php
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
        .products_quantity, pd.products_viewed, p.products_image, pd.products_url, p.products_price, p
        .products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id
        from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
        where p.products_status = '1'
        and p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'
        and pd.products_id = p.products_id
        and pd.language_id = '" . (int)$languages_id . "'
    ");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("
        UPDATE
            " . TABLE_PRODUCTS_DESCRIPTION . "
        SET
            products_viewed = products_viewed+1
        WHERE
            products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'
    ");

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
      <?php echo stripslashes($product_info['products_description']);?>
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

  </div>

</div>
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

</script>
<!-- Property Detail Page -->
		<div class="property-main-details">
			<!-- container -->
			<div class="container">
				<div class="property-details-content property-details-content2 container-fluid p_z">
					<!-- col-md-9 -->
					<div class="col-md-9 col-sm-6 p_l_z">
						<!-- Slider Section -->
						<div id="property-detail1-slider" class="carousel slide property-detail1-slider" data-ride="carousel">
							<!-- Wrapper for slides -->
							<div class="carousel-inner" role="listbox">
								<div class="item active">
									<img src="images/details/detail-slide-1.jpg" alt="Slide">
								</div>
								<div class="item">
									<img src="images/details/detail-slide-1.jpg" alt="Slide">
								</div>
								<div class="item">
									<img src="images/details/detail-slide-1.jpg" alt="Slide">
								</div>
								<div class="item">
									<img src="images/details/detail-slide-1.jpg" alt="Slide">
								</div>
							</div>
							<!-- Controls -->
							<a class="left carousel-control" href="property-detail-2.html#property-detail1-slider" role="button" data-slide="prev">
								<span class="fa fa-long-arrow-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="property-detail-2.html#property-detail1-slider" role="button" data-slide="next">
								<span class="fa fa-long-arrow-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div><!-- Slider Section /- -->
						<div class="property-header">
							<h3>15421 Southwest 39th Terrace - Miami <span>For Rent</span></h3>
							<ul>
								<li>$320/mo</li>
								<li>Product ID : 201354</li>
								<li>
								    Post Date:
								<?php
								     echo date('d-F-Y', strtotime($product_info['products_date_added']));
								?></li>
								<li>
								    <?php echo '<i class="fa fa-eye"></i> ' . $product_info['products_viewed']; ?>
                                </li>
								<li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
								<li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
								<li><i class="fa fa-car"></i>1</li>
							</ul>
							<a title="print" href="property-detail-2.html#"><i class="fa fa-print"></i> Print</a>
						</div>
						<div class="single-property-details">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ullamcorper libero sed ante auctor vel gravida nunc placerat. Suspendisse molestie posuere sem, in viverra dolor venenatis sit amet. Aliquam gravida nibh quis justo pulvinar luctus. Phasellus a malesuada massa. Mauris elementum tempus nisi, vitae ullamcorper sem ultricies vitae. Nullam consectetur lacinia nisi, quis laoreet magna pulvinar in. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In hac habitasse platea dictumst. Cum sociis natoque penatibus et magnis.dis parturient montes, nascetur ridiculus mus.</p>
						</div>
						<div class="general-amenities pull-left">
							<h3>General amenities</h3>
							<div class="amenities-list pull-left">
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-1" checked>
										<label for="checkbox-1">Air conditioning</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-2" checked>
										<label for="checkbox-2">Balcony</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-3" checked>
										<label for="checkbox-3">Bedding</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-4" checked>
										<label for="checkbox-4">Cable TV</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-5" checked>
										<label for="checkbox-5">Cleaning after exit</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-6">
										<label for="checkbox-6">Cofee pot</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-7" checked>
										<label for="checkbox-7">Computer</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-8">
										<label for="checkbox-8">Cot</label>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-9">
										<label for="checkbox-9">Dishwasher</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-10" checked>
										<label for="checkbox-10">DVD</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-11" checked>
										<label for="checkbox-11">Fan</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-12" checked>
										<label for="checkbox-12">Fridge</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-13" checked>
										<label for="checkbox-13">Grill</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-14">
										<label for="checkbox-14">Hairdryer</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-15" checked>
										<label for="checkbox-15">Heating</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-16">
										<label for="checkbox-16">Hi-fi</label>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-17">
										<label for="checkbox-17">Internet</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-18" checked>
										<label for="checkbox-18">Iron</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-19" checked>
										<label for="checkbox-19">Juicer</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-20" checked>
										<label for="checkbox-20">Lift</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-21" checked>
										<label for="checkbox-21">Microwave</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-22">
										<label for="checkbox-22">Oven</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-23" checked>
										<label for="checkbox-23">Parking</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-24">
										<label for="checkbox-24">Parquet</label>
									</div>
								</div>
								<div class="col-md-3 col-sm-12 col-xs-12">
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-25">
										<label for="checkbox-25">Radio</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-26" checked>
										<label for="checkbox-26">Roof terrace</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-27" checked>
										<label for="checkbox-27">Smoking allowed</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-28" checked>
										<label for="checkbox-28">Terrace</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-29" checked>
										<label for="checkbox-29">Toaster</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-30">
										<label for="checkbox-30">Towelwes</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-31" checked>
										<label for="checkbox-31">Use of pool</label>
									</div>
									<div class="amenities-checkbox">
										<input type="checkbox" id="checkbox-32">
										<label for="checkbox-32">Video</label>
									</div>
								</div>
							</div>
						</div>
						<div class="property-direction pull-left">
							<h3>Get Direction</h3>
							<div class="property-map">
								<div id="gmap" class="mapping"></div>
							</div>
							<div class="property-map contact-agent">
								<h3>Contact Agent</h3>
								<div class="col-md-4 agent-details">
									<div class="agent-header">
										<div class="agent-img"><img src="images/single-property/agent.jpg" alt="agent" /></div>
										<div class="agent-name">
											<h5>agent John Doe</h5>
											<ul>
												<li><a href="property-detail-2.html#" title="twitter"><i class="fa fa-twitter"></i></a></li>
												<li><a href="property-detail-2.html#" title="facebook"><i class="fa fa-facebook"></i></a></li>
												<li><a href="property-detail-2.html#" title="google-plus"><i class="fa fa-google-plus"></i></a></li>
											</ul>
										</div>
										<p>Our Latest listed properties and check out the facilities on them test listed properties.</p>
										<p>Our Latest listed properties and check out the facilities on them test listed properties.</p>
									</div>
								</div>
								<div class="col-md-8 agent-information p_z">
									<div class="agent-info">
										<p><i class="fa fa-phone"></i>0123 456 7890</p>
										<p>
											<i class="fa fa-envelope-o"></i>
											<a href="mailto:info@johndoe.com" title="mail">info@johndoe.com</a>
										</p>
										<p><i class="fa fa-fax"></i>041-789-4561</p>
									</div>
									<div class="agent-form">
										<h3>Send Instant Message</h3>
										<form>
											<div class="col-md-6 p_l_z">
												<input type="text" placeholder="Your Name" />
											</div>
											<div class="col-md-6 p_r_z">
												<input type="text" placeholder="Your Email ID" />
											</div>
											<input type="text" placeholder="Message" />
											<input type="submit" value="Submit" class="btn">
										</form>
									</div>
								</div>
							</div>
							<div class="property-map">
								<h3>Share This Property :</h3>
								<ul>
									<li><a href="property-detail-2.html#" title="twitter"><i class="fa fa-twitter"></i></a></li>
									<li><a href="property-detail-2.html#" title="facebook"><i class="fa fa-facebook"></i></a></li>
									<li><a href="property-detail-2.html#" title="google-plus"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="property-detail-2.html#" title="linkedin-square"><i class="fa fa-linkedin-square"></i></a></li>
									<li><a href="property-detail-2.html#" title="pinterest"><i class="fa fa-pinterest"></i></a></li>
									<li><a href="property-detail-2.html#" title="instagram"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="other-properties row">
							<!-- Col-md-4 -->
							<div class="col-md-4 col-xs-12 rent-block">
								<!-- Property Main Box -->
								<div class="property-main-box">
									<div class="property-images-box">
										<span>R</span>
										<a href="property-detail-2.html#"><img src="images/rent/rent-1.jpg" alt="rent" /></a>
										<h4>&dollar;380 / pm</h4>
									</div>
									<div class="clearfix"></div>
									<div class="property-details">
										<a href="property-detail-2.html#">Southwest 39th Terrace</a>
										<ul>
											<li><i class="fa fa-expand"></i>3326 sq</li>
											<li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
											<li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
										</ul>
									</div>
								</div><!-- Property Main Box -->
							</div><!-- Col-md-4 /- -->
							<!-- Col-md-4 -->
							<div class="col-md-4 sale-block">
								<!-- Property Main Box -->
								<div class="property-main-box">
									<div class="property-images-box">
										<span>S</span>
										<a href="property-detail-2.html#"><img src="images/rent/rent-4.jpg" alt="rent" /></a>
										<h4>&dollar;330000</h4>
									</div>
									<div class="clearfix"></div>
									<div class="property-details">
										<a href="property-detail-2.html#">20 Apartments of Type A</a>
										<ul>
											<li><i class="fa fa-expand"></i>3326 sq</li>
											<li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
											<li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
										</ul>
									</div>
								</div><!-- Property Main Box /- -->
							</div><!-- col-md-4 /- -->
							<!-- Col-md-4 -->
							<div class="col-md-4 rent-block">
								<!-- Property Main Box -->
								<div class="property-main-box">
									<div class="property-images-box">
										<span>R</span>
										<a href="property-detail-2.html#"><img src="images/rent/rent-3.jpg" alt="rent" /></a>
										<h4>&dollar;380 / pm</h4>
									</div>
									<div class="clearfix"></div>
									<div class="property-details">
										<a href="property-detail-2.html#">15 Apartments of Type B</a>
										<ul>
											<li><i class="fa fa-expand"></i>3326 sq</li>
											<li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
											<li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
										</ul>
									</div>
								</div><!-- Property Main Box -->
							</div><!-- Col-md-4 /- -->
						</div>
					</div><!-- col-md-9 /- -->
					<!-- col-md-3 -->
					<div class="col-md-3 col-sm-6 p_r_z property-sidebar">
						<aside class="widget widget-search">
							<h2 class="widget-title">search<span>property</span></h2>
							<form>
								<select>
									<option value="selected">Property ID</option>
									<option value="one">One</option>
									<option value="two">Two</option>
									<option value="three">Three</option>
									<option value="four">Four</option>
									<option value="five">Five</option>
								</select>
								<select>
									<option value="selected">Location</option>
									<option value="one">One</option>
									<option value="two">Two</option>
									<option value="three">Three</option>
									<option value="four">Four</option>
									<option value="five">Five</option>
								</select>
								<select>
									<option value="selected">Type</option>
									<option value="one">One</option>
									<option value="two">Two</option>
									<option value="three">Three</option>
									<option value="four">Four</option>
									<option value="five">Five</option>
								</select>
								<select>
									<option value="selected">Status</option>
									<option value="one">One</option>
									<option value="two">Two</option>
									<option value="three">Three</option>
									<option value="four">Four</option>
									<option value="five">Five</option>
								</select>
								<div class="col-md-6 col-sm-6 p_l_z">
									<select>
										<option value="selected">Beds</option>
										<option value="one">One</option>
										<option value="two">Two</option>
										<option value="three">Three</option>
										<option value="four">Four</option>
										<option value="five">Five</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-6 p_r_z">
									<select>
										<option value="selected">Baths</option>
										<option value="one">One</option>
										<option value="two">Two</option>
										<option value="three">Three</option>
										<option value="four">Four</option>
										<option value="five">Five</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-6 p_l_z">
									<select>
										<option value="selected">Min Price</option>
										<option value="one">One</option>
										<option value="two">Two</option>
										<option value="three">Three</option>
										<option value="four">Four</option>
										<option value="five">Five</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-6 p_r_z">
									<select>
										<option value="selected">Max Price</option>
										<option value="one">$3000</option>
										<option value="two">$30000</option>
										<option value="three">$300000</option>
										<option value="four">$3000000</option>
										<option value="five">$3000000000000000</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-6 p_l_z">
									<select>
										<option value="selected">Min Sqft</option>
										<option value="one">One</option>
										<option value="two">Two</option>
										<option value="three">Three</option>
										<option value="four">Four</option>
										<option value="five">Five</option>
									</select>
								</div>
								<div class="col-md-6 col-sm-6 p_r_z">
									<select>
										<option value="selected">Max Sqft</option>
										<option value="one">One</option>
										<option value="two">Two</option>
										<option value="three">Three</option>
										<option value="four">Four</option>
										<option value="five">Five</option>
									</select>
								</div>
								<input type="submit" value="Search Now" class="btn">
							</form>
						</aside>
						<aside class="widget widget-property-featured">
							<h2 class="widget-title">featured<span>property</span></h2>
							<div class="property-featured-inner">
								<div class="col-md-4 col-sm-3 col-xs-2 p_z">
									<a href="property-detail-2.html#" title="Fetured Property"><img src="images/aa-listing/feacture1.jpg" alt="feacture1" /></a>
								</div>
								<div class="col-md-8 col-sm-9 col-xs-10 featured-content">
									<a href="property-detail-2.html#" title="Fetured Property">Southwest 39th Terrace</a>
									<h3>&dollar;350000</h3>
								</div>
							</div>
							<div class="property-featured-inner">
								<div class="col-md-4 col-sm-3 col-xs-2 p_z">
									<a href="property-detail-2.html#" title="Fetured Property"><img src="images/aa-listing/feacture2.jpg" alt="feacture2" /></a>
								</div>
								<div class="col-md-8 col-sm-9 col-xs-10 featured-content">
									<a href="property-detail-2.html#" title="Fetured Property">>Southwest 39th Terrace</a>
									<h3>&dollar;350000</h3>
								</div>
							</div>
							<div class="property-featured-inner">
								<div class="col-md-4 col-sm-3 col-xs-2 p_z">
									<a href="property-detail-2.html#" title="Fetured Property"><img src="images/aa-listing/feacture3.jpg" alt="feacture3" /></a>
								</div>
								<div class="col-md-8 col-sm-9 col-xs-10 featured-content">
									<a href="property-detail-2.html#" title="Fetured Property">Southwest 39th Terrace</a>
									<h3>&dollar;350000</h3>
								</div>
							</div>
						</aside>
					</div><!-- col-md-3 /- -->
				</div>
			</div><!-- container /- -->
		</div><!-- Property Detail Page /- -->

	</div><!-- Page Content -->
<?php
  }
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
