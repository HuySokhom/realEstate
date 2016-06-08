<?php
require('includes/application_top.php');
require(DIR_WS_INCLUDES . 'template_top.php');
?>

<div
    class="container margin-top"
    data-ng-app="main"
>
    <div data-ui-view=""></div>
</div>
<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>


<!-- lib -->
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
    src="ext/ng/lib/angular-ui-bootstrap/ui-bootstrap-tpls-0.12.0.min.js"
></script>

<!-- custom file -->

<script
    type="text/javascript"
    src="ext/ng/app/agents/main.js"
></script>
<script
    type="text/javascript"
    src="ext/ng/app/agents/config/route.js"
></script>
<script
    type="text/javascript"
    src="ext/ng/app/core/restful/restful.js"
></script>
<script
    type="text/javascript"
    src="ext/ng/app/agents/controller/agent_ctrl.js"
></script>
<script
    type="text/javascript"
    src="ext/ng/app/agents/controller/detail_ctrl.js"
></script>
<script
    type="text/javascript"
    src="ext/ng/app/news/directive/search.js"
></script>

