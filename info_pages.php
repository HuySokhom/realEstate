<?php
require('includes/application_top.php');
require(DIR_WS_INCLUDES . 'template_top.php');
$query = tep_db_query("select * from pages_description where pages_id = '". (int)$_GET['pages_id']."'
  and language_id = ". (int)$languages_id ." ");
$content = tep_db_fetch_array($query);
?>

<div class="container margin-top">
  <?php include('advanced_search_box_right.php');?>
  <div class="contentContainer col-md-8 col-sm-6 row">
    <h3 style="margin-top: 0px;"><?php echo $content['pages_title']; ?></h3>
    <p style="text-align: justify;">
      <?php echo $content['content'];?>
    </p>
  </div>
  <div class="col-md-2 col-sm-3" style="text-align: center;">
    <?php include('advertisement_right.php');?>
  </div>
</div>

<?php
require(DIR_WS_INCLUDES . 'template_bottom.php');
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
