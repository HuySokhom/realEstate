<?php
    require('includes/application_top.php');
    require(DIR_WS_INCLUDES . 'template_top.php');
    $query = tep_db_query("select * from content_description where content_id = 1 and language_id = ". (int)$languages_id ." ");
    $content = tep_db_fetch_array($query);
?>

<div class="container margin-top">
  <h4><?php echo $content['title']; ?></h4>

<?php
?>
<div class="contentContainer col-md-9 col-sm-6 p_l_z">
    <p style="text-align: justify;">
        <?php echo $content['content']?>
    </p>
</div>
<?php include('advanced_search_box_right.php');?>
</div>

<?php
  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
