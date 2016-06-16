<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  	require('includes/application_top.php');
	if (!tep_session_is_registered('customer_id')) {
		$navigation->set_snapshot();
		tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
	}
  	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);
  	$breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));

	require(DIR_WS_INCLUDES . 'template_top.php');
?>
<link href="themes/css/table_price.css" rel="stylesheet">
<div
	class="container margin-top"
	data-ng-app="main"
	>
	<?php
	  if ($messageStack->size('account') > 0) {
		echo $messageStack->output('account');
	  }
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel with-nav-tabs panel-default">
				<div class="panel-heading">
					<div class="tab-content">
						<ul class="nav nav-tabs" role="tablist">
							<li ui-sref-active="active">
								<a href="account.php#/manage_property" ui-sref="/manage_property">
									<icon class="fa fa-desktop"></icon>
									<?php echo ENTRY_MANAGE_POST;?>
								</a>
							</li>
							<li ui-sref-active="active" ui-sref="/account">
								<a href="account.php#/account">
									<i class="fa fa-user"></i>
									<?php echo ENTRY_MY_ACCOUNT;?>
								</a>
							</li>
							<?php
								if($_SESSION['user_type'] == 'member'){
							?>
							<li ui-sref-active="active">
								<a ui-sref="/manage_news" href="account.php#/manageNews">
									<i class="fa fa-newspaper-o"></i>
									<?php echo ENTRY_MANAGE_NEWS;?>
								</a>
							</li>
							<?php
								}
							?>
						</ul>
					</div>
				</div>
				<div class="panel-body">
					<div class="tab-content">
						<div data-ui-view=""></div>
					</div>
				</div>
			</div>

			<div class="alert alert-info">
				<i class="fa fa-star"></i>
				Pay Services at SingaProperty.com Prices for publishing ads offers at SingaProperty.com
				The property ads with higher rank are displayed before the other property ads.
				All property ads are with duration of 15/30 days. If the desired number of candidates
				is reached earlier you have the option to stop the property ad.
			</div>

			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-red">
						<div class="panel-heading  text-center">
							<h3>PRO PLAN</h3>
						</div>
						<div class="panel-body arrow_box text-center">
							<p class="lead"><strong>$100 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-danger"></i> Personal use</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i> Unlimited Property</li>
							<li class="list-group-item"><i class="icon-ok text-danger"></i> 27/7 support</li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-danger" href="">BUY NOW!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->
				</div>

				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-blue">
						<div class="panel-heading arrow_box text-center">
							<h3>Premium PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead"><strong>$60 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-info"></i> Personal use</li>
							<li class="list-group-item"><i class="icon-ok text-info"></i> Unlimited projects</li>
							<li class="list-group-item"><i class="icon-ok text-info"></i> 27/7 support</li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-info" href="">BUY NOW!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->
				</div>

				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
					<!-- PRICE ITEM -->
					<div class="panel price panel-green">
						<div class="panel-heading arrow_box text-center">
							<h3>Basic PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead"><strong>$30 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-success"></i> Personal use</li>
							<li class="list-group-item"><i class="icon-ok text-success"></i> Unlimited projects</li>
							<li class="list-group-item"><i class="icon-ok text-success"></i> 27/7 support</li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-success" href="">BUY NOW!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->
				</div>

				<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">

					<!-- PRICE ITEM -->
					<div class="panel price panel-grey">
						<div class="panel-heading arrow_box text-center">
							<h3>FREE PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead"><strong>$0 / month</strong></p>
						</div>
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="icon-ok text-success"></i> Personal use</li>
							<li class="list-group-item"><i class="icon-ok text-success"></i> Unlimited projects</li>
							<li class="list-group-item"><i class="icon-ok text-success"></i> 27/7 support</li>
						</ul>
						<div class="panel-footer">
							<a class="btn btn-lg btn-block btn-primary" href="">BUY NOW!</a>
						</div>
					</div>
					<!-- /PRICE ITEM -->
				</div>

			</div>

		</div>
    <?php
    	// don't need to show
//    	 echo $oscTemplate->getContent('account');
    ?>
	</div>
</div>
<textarea style="display: none;"></textarea>

<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>

<!-- lib -->
<script src="ext/tinymce/tinymce.min.js"></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular/1.5.6/angular.min.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular-cookies/angular-cookies.min.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular-ui-route/angular-ui-router.min.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular-sanitize/angular-sanitize.min.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular-tinymce/tinymce.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular-ui-bootstrap/ui-bootstrap-tpls-0.12.0.min.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/lib/angular-alertify/js/ngAlertify.js"
></script>
<script src="ext/ng/lib/angular-upload/ng-file-upload-shim.min.js"></script>
<!-- for no html5 browsers support -->
<script src="ext/ng/lib/angular-upload/ng-file-upload.min.js"></script>

<script>tinymce.init({ selector:'textarea' });</script>
<!-- custom file -->

<script
	type="text/javascript"
	src="ext/ng/app/account/main.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/config/route.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/core/restful/restful.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/core/services/services.js"
></script>


<script
	type="text/javascript"
	src="ext/ng/app/account/controller/account_ctrl.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/controller/account_edit_ctrl.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/controller/property_ctrl.js"
></script>

<script
	type="text/javascript"
	src="ext/ng/app/account/controller/news_ctrl.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/controller/news_edit_ctrl.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/controller/news_post_ctrl.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/directive/location.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/core/directive/number.js"
></script>
<script
	type="text/javascript"
	src="ext/ng/app/account/directive/image.js"
></script>