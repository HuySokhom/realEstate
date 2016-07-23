</div>
<!-- END PAGE TITLE -->
</div>
<!-- END PAGE CONTENT -->
</div>

<!-- MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
            <div class="mb-content">
                <p>Are you sure you want to log out?</p>
                <p>Press No if you want to continue work. Press Yes to logout current user.</p>
            </div>
            <div class="mb-footer">
                <div class="pull-right">
                    <a href="login.php?action=logoff" class="btn btn-success btn-lg">Yes</a>
                    <button class="btn btn-default btn-lg mb-control-close">No</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>

<script
    type="text/javascript"
    src="js/ng/app/index/controller/index_ctrl.js"
></script>
<!--- News plugin -->
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
<!--- News Type plugin -->
<script
    type="text/javascript"
    src="js/ng/app/news/controller/type_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/news/controller/type_post_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/news/controller/type_edit_ctrl.js"
></script>
<!--- Image Slider plugin -->
<script
    type="text/javascript"
    src="js/ng/app/image_slider/controller/image_slider_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/image_slider/directive/image_slider_popup.js"
></script>
<!--- User plugin -->
<script
    type="text/javascript"
    src="js/ng/app/user/controller/user_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/user/controller/user_edit_ctrl.js"
></script>
<!--- Start location plugin -->
<script
    type="text/javascript"
    src="js/ng/app/location/controller/location_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/location/controller/village_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/location/controller/district_ctrl.js"
></script>
<!--- End location plugin -->
<!-- Start plugin category and product -->
<script
    type="text/javascript"
    src="js/ng/app/category/controller/category_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/product/controller/product_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/product/controller/product_edit_ctrl.js"
></script>
<script
    type="text/javascript"
    src="js/ng/app/product/controller/product_post_ctrl.js"
></script>
<!--- End category and product plugin -->

<!--- Add popular search location plugin -->
<script
    type="text/javascript"
    src="js/ng/app/search_location/controller/search_popular_ctrl.js"
></script>
<!--- Add popular search location plugin -->
<script
    type="text/javascript"
    src="js/ng/app/content/controller/content_ctrl.js"
></script>

<!--- Add customer_plan_ctrl plugin -->
<script
    type="text/javascript"
    src="js/ng/app/customer_plan/controller/customer_plan_ctrl.js"
></script>

<!--- Add report_customer_expire_ctrl plugin -->
<script
    type="text/javascript"
    src="js/ng/app/report_customer_expire/controller/report_customer_expire_ctrl.js"
></script>


</body>
</html>
