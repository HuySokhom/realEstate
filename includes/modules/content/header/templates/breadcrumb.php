<?php
  $url = $_SERVER['REQUEST_URI'];
  $fullUrl = end((explode('/', $url)));
  // check url if is index page
  if( $fullUrl === 'index.php' || $fullUrl == '' ){
    $image_slider_query = tep_db_query("
        select
          text, image
        from
          image_slider
        where
          image != ''
            order by
          sort_order asc limit 10
       ");
    if (tep_db_num_rows($image_slider_query) > 0) {
?>
<link href="ext/css/slider.css" rel="stylesheet">
<script type="text/javascript" src="ext/js/slider/jssor.slider.mini.js"></script>
<script type="text/javascript" src="ext/js/slider.js"></script>
<div
  id="jssor_1"
  style="
  position: relative;
  margin: 0 auto;
  top: 0px; left: 0px;
  width: 1300px; height: 500px;
  overflow: hidden; visibility: hidden;
">
  <!-- Loading Screen -->
  <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
      <div
          style="filter: alpha(opacity=70); opacity: 0.7;
        position: absolute; display: block; top: 0px; left: 0px;
        width: 100%; height: 100%;
      ">
      </div>
      <div
          style="position:absolute;display:block;
          background:url('images/loading.gif') no-repeat center center;top:0px;
          left:0px;width:100%;height:100%;
  ">
      </div>
  </div>
  <div data-u="slides"
       style="
      cursor: default; position: relative;
      top: 0px; left: 0px; width: 1300px;
      height: 500px; overflow: hidden;
   ">
<?php
    while ($image_slider = tep_db_fetch_array($image_slider_query)) {
?>
        <div data-p="225.00" style="display: none;">
          <img data-u="image" src="images/<?php echo $image_slider['image']?>" />
        </div>

<?php
    }
?>
  </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
        <!-- bullet navigator item prototype -->
        <div data-u="prototype" style="width:16px;height:16px;"></div>
    </div>
    <!-- Arrow Navigator -->
    <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
    <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
    <a href="http://www.jssor.com" style="display:none">Bootstrap Carousel</a>
</div>
  <br/>
<?php
    }
  }

?>
<div class="col-sm-<?php echo $content_width; ?>">
  <?php echo $breadcrumb->trail(' &raquo; '); ?>
</div>

