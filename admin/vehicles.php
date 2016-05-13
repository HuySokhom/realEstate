<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">

<?php
require('includes/application_top.php');
?>
<?php 
require(DIR_WS_INCLUDES . 'template_top.php');
?>
<link rel="stylesheet" type="text/css" href="css/custom.css">
<body data-ng-app="main">
	<h4><?php echo HEADING_TITLE; ?></h4>
	<div class="col-md-12">
		<div class="panel with-nav-tabs panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li data-ui-sref-active="active">
						<a data-ui-sref="/type" data-toggle="tab">
							<?php echo VEHICLES_TYPE; ?>
						</a>
					</li>
					<li data-ui-sref-active="active">
						<a 
							data-ui-sref="/brand" 
							data-toggle="tab"
						>
							<?php echo VEHICLES_BRAND; ?>
						</a>
					</li>
					<li data-ui-sref-active="active">
						<a data-ui-sref="/model" data-toggle="tab">
							<?php echo VEHICLES_MODEL; ?>
						</a>
					</li>
					<li data-ui-sref-active="active">
						<a 
							data-ui-sref="/seat" 
							data-toggle="tab"
						>
							<?php echo VEHICLES_SEAT; ?>
						</a>
					</li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div data-ui-view=""></div>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- lib -->
<script 
	type="text/javascript" 
	src="js/jquery/jquery.min.js"
></script>
<script 
	type="text/javascript" 
	src="js/underscore/1.7.0/underscore.js"
></script>
<script 
	type="text/javascript" 
	src="js/ng/lib/angular/1.2.25/angular.js"
></script>
<script 
	type="text/javascript" 
	src="js/ng/lib/angular-ui-route/angular-ui-router.js"
></script>
<script 
	type="text/javascript" 
	src="js/ng/lib/bootstrap/bootstrap-modal.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/lib/angular-ui-bootstrap/ui-bootstrap-tpls-0.12.0.js"
></script>
<!-- custom file -->

<script 
	type="text/javascript"
	src="js/ng/app/vehicles/main.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/config/route.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/controller/vehicle_brand_ctrl.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/controller/vehicle_type_ctrl.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/controller/vehicle_model_ctrl.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/controller/vehicle_seat_ctrl.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/factory/factory.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/services/services.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/app/vehicles/directive/vehicle_popup.js"
></script>

<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>