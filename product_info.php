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
<div class="container margin-top">

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
        select p.products_id, p.products_kind_of, p.products_image_thumbnail, pd.products_name, v.name_en as village_name,
        l.name as province_name, d.name_en as district_name,
        pd.products_description, p.products_model, p.products_quantity, p.bed_rooms, p.bath_rooms, p.number_of_floors,
        pd.products_viewed, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id,
        p.products_date_added, p.products_date_available, p.manufacturers_id, p.village_id, p.district_id, p.province_id
        from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, location l, village v, district d
        where p.products_status = '1'
        and v.id = p.village_id
        and l.id = p.province_id
        and d.id = p.district_id
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
<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>
<div class="contentContainer">
<?php
	if(!empty($_SERVER['HTTPS'])){
		$url = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}else{
		$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}
	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.$product_info['products_name'].'&amp;url='.$url;
	$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$url;
	$googleURL = 'https://plus.google.com/share?url='.$url;
	$linkedinURL = 'http://www.linkedin.com/shareArticle?url='.$url.'&title='.$product_info['products_name'].'';

    if (tep_not_null($product_info['products_image'])) {

		$pi_query = tep_db_query("select image, image_thumbnail, htmlcontent from " . TABLE_PRODUCTS_IMAGES . " where
        products_id = '" . (int)$product_info['products_id'] . "'order by sort_order");
        $pi_total = tep_db_num_rows($pi_query);
    }
?>
<!-- Property Detail Page -->
		<div class="">
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
									<img src="<?php echo DIR_WS_IMAGES . $product_info['products_image'];?>" />
								</div>
								 <?php
                                    if ($pi_total > 0) {
                                        while ($pi = tep_db_fetch_array($pi_query)) {
                                            echo '<div class="item">';
                                            echo '<img data-u="image" src="' . DIR_WS_IMAGES . $pi['image'] . '"/>';
                                            echo '</div>';
                                        }
                                    }
                                ?>
							</div>
							<!-- Controls -->
							<a class="left carousel-control" href="#property-detail1-slider" role="button" data-slide="prev">
								<span class="fa fa-long-arrow-left" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#property-detail1-slider" role="button" data-slide="next">
								<span class="fa fa-long-arrow-right" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div><!-- Slider Section /- -->
						<div class="property-header">
							<h3>
							    <?php
							        echo $product_info['products_name'];
							        echo '<span>' . $product_info['products_kind_of'] . '</span>';
							    ?>
                            </h3>
							<ul>
								<li>
								<?php
								    echo '<span  data-toggle="tooltip" data-placement="top" title="Price">' . $currencies->display_price($product_info['products_price']) . '</span>';
								?>
                                </li>
								<li>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-product-hunt"  data-toggle="tooltip" data-placement="top" title="Product ID"></i>
                                        <?php echo $product_info['products_id']; ?>
                                    </a>
                                </li>
								<li>
								<?php
								     echo '<a href="javascript:void(0)">
                                            <i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="Post Date"></i> '
                                         . date('d-F-Y', strtotime($product_info['products_date_added'])) . '</a>';
								?></li>
								<li>
								    <?php echo '<a href="javascript:void(0)">
										<i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="Product Views"></i>
										' . $product_info['products_viewed'] . '</a>';?>
                                </li>
								<li>
								    <?php
								        echo '<a href="javascript:void(0)">
											<i class="fa fa fa-bed" data-toggle="tooltip" data-placement="top" title="Bed Rooms"></i> '
											. $product_info['bed_rooms'] . '</a>';
								    ?>
								</li>
								<li>
                                    <?php
                                        echo '<a href="javascript:void(0)"><img src="images/icon/bath-icon.png"
                                            style="
                                                width: 17px;
                                                height: 13px;
                                                margin: 4px 0px 11px 0px;
                                            "
                                            data-toggle="tooltip" data-placement="top" title="Bath Rooms"
                                            > ' . $product_info['bath_rooms'] .'</a>';
                                    ?>
                                </li>
								<li>
                                    <?php
                                        echo '<a href="javascript:void(0)">
											<i class="fa fa fa-institution" data-toggle="tooltip" data-placement="top" title="Number of Floors"></i> '
											. $product_info['number_of_floors'] . '</a>';
                                    ?>
                                </li>
                                <li>
									<a
										href="<?php echo $twitterURL?>"
								   		title="Share On Twitter"
										data-toggle="tooltip"
										data-placement="top"
										target="_blank"
									>
										<i class="fa fa-twitter"></i>
									</a>
								</li>
                                <li>
									<a href="<?php echo $facebookURL?>"
									   title="Share On Facebook"
									   data-toggle="tooltip"
									   data-placement="top"
									   target="_blank"
									>
										<i class="fa fa-facebook-official"></i>
									</a>
								</li>
                                <li>
									<a href="<?php echo $googleURL?>"
									   title="Share On Google-plus"
									   data-toggle="tooltip"
									   data-placement="top"
									   target="_blank"
									>
										<i class="fa fa-google-plus"></i>
									</a>
								</li>
                                <li>
									<a href="<?php echo $linkedinURL?>"
									   data-toggle="tooltip"
									   data-placement="top"
									   title="Share On Linkedin"
									   target="_blank"
									>
										<i class="fa fa-linkedin-square"></i>
									</a>
								</li>
							</ul>
						</div>
						<div class="single-property-details">
							 <?php echo stripslashes($product_info['products_description']);?>
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

                            <?php
                            include(DIR_WS_MODULES . 'relate_products.php');
                            ?>
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
