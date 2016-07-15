</div> </div> </div> <!-- bodyContent //-->
<!-- Footer Section -->
<div id="footer-section" class="footer-section">
    <!-- container -->
    <div class="container">
        <!-- col-md-3 -->
        <div class="col-md-4 col-sm-6">
            <div class="footerbox">
                <h3><?php echo HEADING_FOOTER_PROFILE; ?></h3>
                <address>
                    <strong><?php echo STORE_NAME; ?></strong><br>
                    <?php echo nl2br(STORE_ADDRESS); ?><br>
                    Phone:
                    <?php echo STORE_PHONE; ?>
                    <br>
                    Email:
                    <a href="mailto:<?php echo STORE_OWNER_EMAIL_ADDRESS; ?>" target="_top">
                        <?php echo STORE_OWNER_EMAIL_ADDRESS; ?>
                    </a>
                </address>
            </div>
        </div><!-- col-md-3 -->

        <!-- col-md-3 -->
        <div class="col-md-4 col-sm-6">
            <!-- Quick Link Widget -->
            <aside class="footerbox">
                <h3 class="widget-title"><?php echo HEADING_FOOTER_CONTACT; ?></h3>
                <div><a title="contact" href="contact_us.php"><?php echo HEADING_FOOTER_CONTACT; ?></a></div>
                <div><a title="about" href="about_us.php"><?php echo HEADING_FOOTER_ABOUT; ?></a></div>
            </aside>
            <!-- Quick Link Widget /- -->
        </div><!-- col-md-3 -->

        <!-- col-md-3 -->
        <div class="col-md-4 col-sm-6">
            <!-- Address Widget -->
            <aside class="footerbox">
                <h3 class="widget-title"><?php echo HEADING_FOOTER_TERM; ?></h3>
                <div>
                    Privacy Policy
                </div>
                <div>
                    Terms & Conditions
                </div>
                <div>
                    Disclaimer
                </div>
            </aside>
            <!-- Address Widget /- -->
        </div><!-- col-md-3 -->
   </div><!-- container /- -->
    <!-- Footer Bottom -->
    <div id="footer-bottom" class="footer-bottom">
        <!-- container -->
        <div class="container">
            <p class="col-md-4 col-sm-6 col-xs-12">
            <?php
                echo 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '.</a>';
            ?>
                Power by <a href="https://www.facebook.com/skwebsolution/" target="_blank">SK Web Solution</a>
            </p>
            <div class="col-md-4 col-sm-6 col-xs-12 pull-right social">
                <ul class="footer_social m_b_z">

                </ul>
                <a href="javascript:void(0)" title="back-to-top" id="back-to-top" class="back-to-top"><i class="fa fa-long-arrow-up"></i> Top</a>
            </div>
        </div><!-- container /- -->
    </div><!-- Footer Bottom /- -->
</diV><!-- Footer Section -->
<!--<script src="ext/bootstrap/js/bootstrap.min.js"></script>-->
<!--<script src="themes/libraries/jquery.easing.min.js"></script><!-- Easing Animation Effect -->
<script src="themes/libraries/bootstrap/bootstrap.min.js"></script> <!-- Core Bootstrap v3.2.0 -->
<!--<script src="themes/libraries/modernizr/modernizr.custom.37829.js"></script> <!-- Modernizer -->
<!--<script src="themes/libraries/jquery.appear.js"></script> <!-- It Loads jQuery when element is appears -->
<script src="themes/libraries/owl-carousel/owl.carousel.min.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
<!--<script src="themes/libraries/checkbox/icheck.min.js"></script> <!-- Check box -->
<!--<script src="themes/libraries/drag-drop/jquery.tmpl.min.js"></script> <!-- Drag Drop file -->
<!--<script src="themes/libraries/drag-drop/drag-drop.js"></script> <!-- Drag Drop File -->
<!--<script src="themes/libraries/drag-drop/modernizr.custom.js"></script> <!-- Drag Drop File -->
<!--<script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false'></script>-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKqUQ4QmbTWM_KNhkYg7erVxakz_0-noE&v=3.exp"></script>
<script src="themes/libraries/gmap/jquery.gmap.min.js"></script> <!-- map -->
<!--<script src="themes/libraries/expanding-search/classie.js"></script>-->
<!--<script src="themes/libraries/expanding-search/uisearch.js"></script>-->

<!-- Customized Scripts -->
<script src="themes/js/functions.js"></script>
<?php echo $oscTemplate->getBlocks('footer_scripts'); ?>

</body>
</html>