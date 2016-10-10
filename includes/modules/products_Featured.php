<?php
$new_products_query_sale = tep_db_query("
      select
        p.products_id,
        pd.products_viewed,
        p.products_image_thumbnail,
        p.products_image,
        p.products_promote,
        p.bed_rooms,
        p.bath_rooms,
        p.number_of_floors,
        p.products_tax_class_id,
        pd.products_name,
        if(s.status, s.specials_new_products_price, p.products_price) as products_price
      from
        " . TABLE_PRODUCTS . " p
            left join
        " . TABLE_SPECIALS . " s
            on
        p.products_id = s.products_id,
        " . TABLE_PRODUCTS_DESCRIPTION . " pd
    where
        p.products_status = 1
            and
        p.products_id = pd.products_id
            and
        pd.language_id = '" . (int)$languages_id . "'
            order by
        p.products_promote desc, rand(), p.products_date_added desc
        limit 4"
);

$num_new_products_sale = tep_db_num_rows($new_products_query_sale);

if ($num_new_products_sale > 0) {

    $new_prods_content = NULL;

    while ($new_products_sale = tep_db_fetch_array($new_products_query_sale)) {
        switch ($new_products_sale['products_promote']) {
            case 3:
                $classMd = 'col-md-6';
                $classSm = 'col-md-6';
                break;
            case 2:
                $classMd = 'col-md-4';
                $classSm = 'col-md-4';
                break;
            case 1:
                $classMd = 'col-md-3';
                $classSm = 'col-md-3';
                break;
            default:
                $classMd = 'col-md-3';
                $classSm = 'col-md-3';
        }
        $new_prods_content_sale .= '

        <div class="item">
          <!-- col-md-12 -->
          <div class="'.$classMd.' '.$classSm.' col-home rent-block">
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
                        SMALL_IMAGE_HEIGHT, 'style="width:100%; height: 170px;"'
                    ) .
                '
                </a>
                <h4>
                    ' . $currencies->display_price($new_products_sale['products_price'], tep_get_tax_rate($new_products_sale['products_tax_class_id'])) . '
                </h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="">' . $new_products_sale['products_name'] . '</a>
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
    <div class="">
        <div class="p_r_z">
            <div class="sale-property-block">
                <?php echo $new_prods_content_sale; ?>
            </div>
        </div>
    </div>
    <?php
}
?>