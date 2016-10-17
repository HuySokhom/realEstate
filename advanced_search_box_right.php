<?php
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);
?>
<div class="col-md-2 col-sm-3 property-sidebar widget-area">
  <aside class="widget widget-search">
    <h2 class="widget-title">
      <?php echo TEXT_SEARCH;?>
      <span>
        <?php echo PROPERTY;?>
      </span></h2>
    <form name="advance_search" action="advanced_search_result.php" method="get">
      <?php
        echo tep_draw_input_field('keywords', '', 'required aria-required="true" id="inputKeywords" placeholder="' . SEARCH . '"', 'search');
        echo tep_draw_hidden_field('search_in_description', '1');
        ?>
      <br>
    <?php
        echo tep_draw_pull_down_menu(
            'categories_id',
            tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES))),
            NULL,
            'id="entryCategories"');
      ?>
      <?php
        echo tep_draw_pull_down_menu(
            'location',
            tep_get_province(array(array('id' => '', 'text' => TEXT_ALL_LOCATION))),
            NULL,
            'id="province"'
        );
      ?>

      <select name="type">
        <option value=""><?php echo TEXT_TYPE;?></option>
        <option value="For Rent"><?php echo RENT?></option>
        <option value="For Sale"><?php echo SALE?></option>
        <option value="Both Sale and Rent"><?php echo BOTH?></option>
      </select>
      <div class="col-md-6 col-sm-6 p_l_z" name="bed_from">
        <select name="bfrom">
          <option value=""><?php echo ENTRY_BED_FROM?></option>
          <?php
            $n = 20;
            for($i=1; $i <= $n; $i++){
              echo "<option value=$i>$i</option>";
            }
          ?>
        </select>
      </div>
      <div class="col-md-6 col-sm-6 p_r_z" name="bed_to">
        <select name="bto">
          <option value=""><?php echo ENTRY_BED_TO?></option>
          <?php
          $n = 20;
          for($i=1; $i <= $n; $i++){
            echo "<option value=$i>$i</option>";
          }
          ?>
        </select>
        </select>
      </div>
      <div class="col-md-6 col-sm-6 p_l_z">
        <select name="pfrom">
          <option value=""><?php echo ENTRY_PRICE_FROM?></option>
          <option value="10000">$10000</option>
          <option value="30000">$30000</option>
          <option value="60000">$60000</option>
          <option value="100000">$100000</option>
          <option value="500000">$500000</option>
          <option value="1000000">$1000000+</option>
        </select>
      </div>
      <div class="col-md-6 col-sm-6 p_r_z">
        <select name="pto">
          <option value=""><?php echo ENTRY_PRICE_TO?></option>
          <option value="10000">$10000</option>
          <option value="30000">$30000</option>
          <option value="60000">$60000</option>
          <option value="100000">$100000</option>
          <option value="500000">$500000</option>
          <option value="1000000">$1000000+</option>
        </select>
      </div>

      <input type="submit" value="<?php echo SEARCH;?>" class="btn">
    </form>
  </aside>

  <?php
    $adv_query = tep_db_query("
      SELECT link, title, image
      FROM advertising_banner
      WHERE
        status = 1
          AND
        location = 'left'
      ORDER BY
        sort_order ASC
    ");
  $num_adv = tep_db_num_rows($adv_query);
  if ($num_adv > 0) {
    while ($adv = tep_db_fetch_array($adv_query)) {
      echo '
        <a href="http://' . $adv['link'] . '" title="' . $adv['title'] . '">
          <img src="images/' . $adv['image'] . '" class="adv"/>
        </a>
      ';
    }
  }
  ?>
</div>
