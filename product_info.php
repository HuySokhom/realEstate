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
<div class="container margin-top" data-ng-controller="send_mail_ctrl">

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
        select
			p.products_id,
			p.customers_id,
			p.products_kind_of,
			p.products_image_thumbnail,
			pd.products_name,
			v.name_en as village_name,
			l.name as province_name,
			d.name_en as district_name,
			pd.products_description,
			p.map_lat,
			p.map_long,
			p.bed_rooms,
			p.bath_rooms,
			p.number_of_floors,
			pd.products_viewed,
			p.products_image,
			p.products_price,
			p.products_tax_class_id,
			p.products_date_added
        from
        	" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, location l, village v, district d
        where
        	p.products_status = '1'
        		and
			v.id = p.village_id
        		and
			l.id = p.province_id
        		and
			d.id = p.district_id
        		and
			p.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "'
        		and
			pd.products_id = p.products_id
        		and
			pd.language_id = '" . (int)$languages_id . "'
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
							        echo $product_info['products_name'] . ' | ' . $product_info['village_name']
											. ' | ' . $product_info['district_name'] . ' | ' . $product_info['province_name']
									;
							        echo '<span>' . $product_info['products_kind_of'] . '</span>';
							    ?>
                            </h3>
							<ul>
								<li>
								<?php
								    echo '<span  data-toggle="tooltip" data-placement="top" title="Price">'
											. $currencies->display_price($product_info['products_price'])
											. '</span>';
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
								<input type="text" hidden id="lat" value="<?php echo $product_info['map_lat'];?>"/>
								<input type="text" hidden id="long" value="<?php echo $product_info['map_long'];?>"/>
								<div id="map_canvas" class="mapping"></div>
							</div>
							<?php
								include(DIR_WS_MODULES . 'contact_person.php');
							?>
						</div>
						<?php
							include(DIR_WS_MODULES . 'relate_products.php');
						?>
					</div><!-- col-md-9 /- -->
					<!-- col-md-3 -->
					<?php
						require('advanced_search_box_right.php');
					?>
					<!-- col-md-3 /- -->
				</div>
			</div><!-- container /- -->
		</div><!-- Property Detail Page /- -->

	</div><!-- Page Content -->
<?php
  }
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
<script
	type="text/javascript"
	src="ext/ng/lib/angular/1.3.15/angular.min.js"
></script>
<script>
	var app = angular.module('main', []);
	app.controller(
		'send_mail_ctrl', [
			'$scope'
			, '$http'
			, function ($scope, $http){
				$scope.language_id = '';
				$scope.sendMail = function(){
					var params = {
						name: $scope.name,
						email: $scope.email,
						enquiry: $scope.enquiry
					};
					console.log(params);
					$http({
						url: 'api/SendMail',
						method: 'POST',
						headers: {
							'Content-Type': undefined
						},
						data: JSON.stringify(params)
					}).success(function(data){
						console.log(data);
					});
				};


			}
		]);
</script>