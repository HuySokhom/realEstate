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


<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
