<?php
require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);
?>
<div class="col-md-3 col-sm-6 p_r_z property-sidebar widget-area">
  <aside class="widget widget-search">
    <h2 class="widget-title">
      <?php echo TEXT_SEARCH;?>
      <span>
        <?php echo PROPERTY;?>
      </span></h2>
    <form name="advance_search" action="advanced_search_result.php" method="get">
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

  <aside class="widget widget-property-featured">
    <h2 class="widget-title">
      <?php echo FEATURED; ?>
      <span>
        <?php echo PROPERTY;?>
      </span>
    </h2>
  </aside>
  <?php
    $featured_query = tep_db_query("
      SELECT p.products_id, p.products_image_thumbnail, p.products_price, pd.products_name
      FROM products p, products_description pd
      WHERE
        p.products_status = 1
          AND
        p.products_id = pd.products_id
          AND
        p.products_id != '" . (int)$HTTP_GET_VARS['products_id'] . "'
          AND
        pd.language_id = '" . (int)$languages_id . "'
      ORDER BY
        p.products_promote DESC, p.products_date_added DESC
      LIMIT 5
    ");
  $num_featured = tep_db_num_rows($featured_query);
  if ($num_featured > 0) {
    while ($featured = tep_db_fetch_array($featured_query)) {
  ?>
  <div class="property-featured-inner">
    <div class="col-md-4 col-sm-3 col-xs-2 p_z">
      <a
          title="Property Image"
          href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured['products_id']) ?>"
          >
        <?php
          echo tep_image(
              DIR_WS_IMAGES . $featured['products_image_thumbnail'],
              $featured['products_name'],
              SMALL_IMAGE_WIDTH,
              SMALL_IMAGE_HEIGHT,
              'style="width:100%; height: 70px;"'
          )
        ?>
      </a>
    </div>
    <div class="col-md-8 col-sm-9 col-xs-10 featured-content">
      <a title="Featured Post" href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured['products_id']) ?>">
        <?php echo $featured['products_name'];?>
      </a>
      <h3><?php echo $featured['products_price'];?></h3>
    </div>
  </div>
  <?php
      }
    }
  ?>
</div>