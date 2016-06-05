<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/fonts/font-awesome.min.css">
<?php
require('includes/application_top.php');
?>
<?php 
require(DIR_WS_INCLUDES . 'template_top.php');
?>
<link rel="stylesheet" type="text/css" href="css/custom.css">
<body data-ng-app="main">
	<h4>News Management</h4>
	<div class="col-md-12">
		<div class="panel with-nav-tabs panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li data-ui-sref-active="active">
						<a href="news.php#/manage_article"  data-ui-sref="/manage_article">
							News Articles
						</a>
					</li>
					<li data-ui-sref-active="active">
						<a 
							data-ui-sref="/type"
							href="news.php#/type"
						>
							News Type
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

<script src="css/bootstrap/bootstrap.min.js"></script>
<script
	type="text/javascript"
	src="js/tinymce/tinymce.min.js"
></script>
<script 
	type="text/javascript" 
	src="js/ng/lib/angular/1.5.6/angular.min.js"
></script>
<script
	type="text/javascript"
	src="js/ng/lib/angular-cookies/angular-cookies.min.js"
></script>
<script
	type="text/javascript"
	src="js/ng/lib/angular-ui-route/angular-ui-router.min.js"
></script>
<script
	type="text/javascript"
	src="js/ng/lib/angular-sanitize/angular-sanitize.min.js"
></script>
<script 
	type="text/javascript"
	src="js/ng/lib/angular-ui-bootstrap/ui-bootstrap-tpls-0.12.0.min.js"
></script>
<script
	type="text/javascript"
	src="js/ng/lib/angular-tinymce/tinymce.js"
></script>
<script
	type="text/javascript"
	src="js/ng/lib/bootstrap-notify/bootstrap-notify.min.js"
></script>
<script src="js/ng/lib/angular-upload/ng-file-upload-shim.min.js"></script>
<!-- for no html5 browsers support -->
<script src="js/ng/lib/angular-upload/ng-file-upload.min.js"></script>

<!-- custom file -->

<script
	type="text/javascript"
	src="js/ng/app/news/main.js"
></script>
<script
	type="text/javascript"
	src="js/ng/app/news/config/route.js"
></script>
<script
	type="text/javascript"
	src="js/ng/app/core/restful/restful.js"
></script>
<script
		type="text/javascript"
		src="js/ng/app/core/services/services.js"
></script>
<script
	type="text/javascript"
	src="js/ng/app/news/controller/news_ctrl.js"
></script>
<script
	type="text/javascript"
	src="js/ng/app/news/controller/news_post_ctrl.js"
></script>
<script
	type="text/javascript"
	src="js/ng/app/news/controller/news_edit_ctrl.js"
></script>
<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>