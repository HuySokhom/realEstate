<?php
    $new_query = tep_db_query("
      select
        n.id,
        n.image_thumbnail,
        nd.title
      from
        news n
            inner join
        news_description nd
            on
        n.id = nd.news_id
    where
        n.status = 1
          and
        nd.language_id = '" . (int)$languages_id . "'
            order by
        n.id asc, rand()
        limit 10"
    );

  $num_new = tep_db_num_rows($new_query);
  if ($num_new > 0) {
    while ($new = tep_db_fetch_array($new_query)) {    
      $news .= '
        <div class="item">
          <div class="col-md-12 rent-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a
                    title="Property Image"
                    href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products_sale['products_id']) . '"
                >
                '
                    . tep_image(DIR_WS_IMAGES . $new_products_sale['products_image_thumbnail'],
                    $new_products_sale['products_name'], SMALL_IMAGE_WIDTH,
                    SMALL_IMAGE_HEIGHT, 'style="width:100%; height: 170px;"') .
                '
                    </a>
                <h4>
                    ' . $currencies->display_price($new_products_sale['products_price'], tep_get_tax_rate($new_products_sale['products_tax_class_id'])) . '
                </h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">' . $p_name . '</a>
                <ul>
                  <li>
                      <i class="fa fa fa-institution"></i>
                      ' . $new_products_sale['number_of_floors'] . '
                  </li>
                  <li>
                    <i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>
                    '. $new_products_sale['bed_rooms'] .'
                  </li>
                  <li>
                    <i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>
                    '. $new_products_sale['bath_rooms'] . '
                  </li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div><!-- col-md-12 /- -->
       </div>
          ';
    }
?>
    <!-- Rent Property -->
    <div class="sale-property">
    <div class="col-md-6 rent">
      <div class="section-header">
        <h3><span><?php echo PROPERTY; ?></span><?php echo FREE;?></h3>
      </div>
    </div>
    <div class="col-md-12 p_r_z">
    <div id="sale-property-block" class="sale-property-block">
      <?php echo $news; ?>
    </div>
    </div>
  </div><!-- Rent Property /- -->
<?php
  }