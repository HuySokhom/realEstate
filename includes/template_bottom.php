</div> </div> </div> <!-- bodyContent //-->
<!-- Footer Section -->
<div id="footer-section" class="footer-section">
    <!-- container -->
    <div class="container">
        <!-- col-md-3 -->
        <div class="col-md-3 col-sm-3">
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
        <div class="col-md-3 col-sm-3">
            <!-- Quick Link Widget -->
            <aside class="footerbox">
                <h3 class="widget-title"><?php echo HEADING_FOOTER_CONTACT; ?></h3>
                <div>
                    <a title="<?php echo TEXT_CONTACT_US; ?>" href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=7');?>">
                        <?php echo TEXT_CONTACT_US; ?>
                    </a>
                </div>
                <div>
                    <a title="<?php echo TEXT_ABOUT_US; ?>" href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=6');?>">
                        <?php echo TEXT_ABOUT_US; ?>
                    </a>
                </div>
                <div>
                    <a title="<?php echo TEXT_SERVICE; ?>" href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=3');?>">
                        <?php echo TEXT_SERVICE; ?>
                    </a>
                </div>
                <div>
                    <a title="<?php echo TEXT_LINK; ?>" href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=4');?>">
                        <?php echo TEXT_LINK; ?>
                    </a>
                </div>
                <div>
                    <a title="<?php echo TEXT_GUIDE; ?>" href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=5');?>">
                        <?php echo TEXT_GUIDE; ?>
                    </a>
                </div>
            </aside>
            <!-- Quick Link Widget /- -->
        </div><!-- col-md-3 -->

        <!-- col-md-3 -->
        <div class="col-md-3 col-sm-3">
            <!-- Address Widget -->
            <aside class="footerbox">
                <h3 class="widget-title"><?php echo HEADING_FOOTER_TERM; ?></h3>
                <div>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=8');?>">
                        <?php echo PRIVACY_POLICY;?>
                    </a>
                </div>
                <div>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=9');?>">
                        <?php echo Terms_Conditions;?>
                    </a>
                </div>
                <div>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=10');?>"><?php echo Disclaimer;?></a>
                </div>
                <div>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=2');?>">
                        <?php echo TEXT_COMMUNITY;?>
                    </a>
                </div>
                <div>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=1');?>">
                        <?php echo TEXT_PUBLICATION;?>
                    </a>
                </div>
            </aside>
            <!-- Address Widget /- -->
        </div><!-- col-md-3 -->
        <div class="col-md-3 col-sm-3">
            <aside class="footerbox">
                <h3 class="widget-title"><?php echo POPULAR_LOCATION; ?></h3>
                <?php
                    $queryPopLocation = tep_db_query("select location_id, name from search_location");
                    while( $popLocation = tep_db_fetch_array($queryPopLocation)){
                        echo '<div>
                                <a href="advanced_search_result.php?&location='. $popLocation['location_id'] .'">
                                    '. $popLocation['name'] .'
                                </a>
                            </div>
                        ';
                    }
                ?>

            </aside>
        </div>
   </div><!-- container /- -->
    <!-- Footer Bottom -->
    <div id="footer-bottom" class="footer-bottom">
        <!-- container -->
        <div class="container">
            <p class="col-md-6 col-sm-6 col-xs-12">
            <?php
                echo 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '.</a>';
            ?>
                Power by <a href="https://www.facebook.com/skwebsolution/" target="_blank">SK Web Solution</a>
            </p>
            <div class="col-md-4 col-sm-6 col-xs-12 pull-right social">
                <ul class="footer_social m_b_z">

                </ul>
                <a href="javascript:void(0)" title="back-to-top" id="back-to-top" class="back-to-top">
                    <i class="fa fa-long-arrow-up"></i>
                    Top
                </a>
            </div>
        </div><!-- container /- -->
    </div><!-- Footer Bottom /- -->
</diV><!-- Footer Section -->
<script src="themes/libraries/bootstrap/bootstrap.min.js"></script> <!-- Core Bootstrap v3.2.0 -->
<script src="themes/libraries/owl-carousel/owl.carousel.min.js"></script> <!-- Core Owl Carousel CSS File  *	v1.3.3 -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKqUQ4QmbTWM_KNhkYg7erVxakz_0-noE&v=3.exp"></script>
<script src="themes/libraries/gmap/jquery.gmap.min.js"></script> <!-- map -->
<script src="themes/js/alertify.js"></script>
<!-- Customized Scripts -->
<script src="themes/js/functions.js"></script>
<?php echo $oscTemplate->getBlocks('footer_scripts'); ?>
<script>
    $(function(){
        var windowScroll, windowsize;
        // detect window scroll function 
        $(window).scroll(function(){
            windowScroll = $(this).scrollTop();
            //console.log( windowScroll );
            if(windowScroll < 136){
                $('.scrollPost').css('display','none');
                $('.navigation-block').css('position', 'relative');
            }else{
                if (windowsize < 790) {
                    $('.scrollPost').css('display','none');
                }else{
                    $('.scrollPost').css('display','block');
                }
                var styles = {
                    "position": "fixed",
                    "top": 0,
                    //"border-bottom": "3px solid crimson"
                };
                $('.navigation-block').css(styles);
            }
        });
        // detect window resize screen function
        $(window).resize(function() {
            windowsize = $(window).width();
            //console.log(windowsize);
            if (windowsize > 790) {
                $('.scrollPost').css('display','block');
            }else{
                $('.scrollPost').css('display','none');
            }
        });
    });
</script>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=1423595867869606";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>