<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">

<?php
require('includes/application_top.php');
?>
<?php
require(DIR_WS_INCLUDES . 'template_top.php');
?>
<link rel="stylesheet" type="text/css" href="css/custom.css">
<link rel="stylesheet" type="text/css" href="css/image_slider.css">
<body data-ng-app="main">
<h4>Image Slider</h4>
<div class="panel-body">
    <div class="tab-content">
        <div data-ui-view=""></div>
    </div>
</div>
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
<script src="js/ng/lib/angular-upload/ng-file-upload-shim.js"></script>
<!-- for no html5 browsers support -->
<script src="js/ng/lib/angular-upload/ng-file-upload.js"></script>
<!-- custom file -->

<script
    type="text/javascript"
    src="js/ng/app/image_slider/main.js"
    ></script>
<script
    type="text/javascript"
    src="js/ng/app/image_slider/config/route.js"
    ></script>
<script
    type="text/javascript"
    src="js/ng/app/image_slider/controller/image_slider_ctrl.js"
    ></script>
<script
    type="text/javascript"
    src="js/ng/app/image_slider/factory/factory.js"
    ></script>
<script
    type="text/javascript"
    src="js/ng/app/image_slider/services/services.js"
    ></script>
<script
    type="text/javascript"
    src="js/ng/app/image_slider/directive/image_slider_popup.js"
    ></script>
</body>
<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>