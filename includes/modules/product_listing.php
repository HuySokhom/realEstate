<?php
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_SEARCH_RESULTS, 'p.products_id');
?>

<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>
  <div class="container">
<?php
  if ($listing_split->number_of_rows > 0) {
  $listing_query = tep_db_query($listing_split->sql_query);
  $prod_list_contents = NULL;

  while ($listing = tep_db_fetch_array($listing_query)) {
    if (strlen(strip_tags($listing['products_description'], '<br>')) > 350){
       $str_description = substr(strip_tags($listing['products_description'], '<br>'), 0, 350) . '...';
   }else{
        $str_description = strip_tags($listing['products_description'], '<br>');
   }
   switch ($listing['products_promote']) {
        case 3:
            $text = 'Pro Featured';
            $class = 'pro';
            break;
        case 2:
            $text = 'Premium Featured';
            $class = 'premium';
            break;
        case 1:
            $text = 'Basic Featured';
            $class = 'basic';
            break;
        default:
            $text = 'Free';
            $class = 'free';
    }
    $prod_list_contents .= '
        <div class="property-listing-box sale-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="col-md-4 p_z">
                <a title="Property Image" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '">
                     ' . tep_image(DIR_WS_IMAGES . $listing['products_image_thumbnail'], '', '', '', 'style="width: 100%;height: 181px;"') . '
                </a>
                <div class="' . $class . '">'. $text .'</div>
              </div>
              <div class="col-md-8 p_z">
                <div class="property-details">
                  <a
                    title="Property Title"
                    href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing['products_id']) . '"
                  >
                    ' . $listing['products_name'] .'
                  </a>
                  <h4>
                    ' . $currencies->display_price($listing['products_price'], tep_get_tax_rate($listing['products_tax_class_id'])) .'
                  </h4>
                  <p>
                    ' . $str_description .'
                  </p>
                  <ul>
                    <li>
                        <i
                            class="fa fa-heart-o heart-icon"
                            data-product="'. $listing['products_id']. '"
                            data-type="insert"
                        ></i>
                    </li>
                    <li><i class="fa fa-eye"></i> '. $listing['products_viewed'] .' </li>
                        <li><img src="images/aa-listing/bedroom-icon.png" alt="bedroom-icon"> '.$listing['bed_rooms'].' </li>
                    <li><img src="images/aa-listing/bathroom-icon.png" alt="bathroom-icon"> '.$listing['bath_rooms'].' </li>
                    <li><i class="fa fa fa-institution"></i> ' . $listing['number_of_floors'] . ' </li>
                  </ul>
                </div>
              </div>
            </div><!-- Property Main Box /- -->
          </div>';

  }

    echo ' <!-- Property Listing Section -->
        <div id="property-listing" class="property-listing">
            <div class="container">
              <div class="property-left col-md-9 col-sm-6 p_l_z content-area">
                <div class="section-header p_l_z">
                  <div class="col-md-10 col-sm-10 p_l_z">
                    <p>' . PROPERTY . '</p>
                    <h3>' . LISTING . '</h3>
                  </div>
                </div>
    ';
    echo $prod_list_contents;
    ?>

    <!-- Pagination -->
      <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <div>
              <?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS) ?>
          </div>
          <div class="pagenav">
            <ul class="pagination">
              <?php
                echo $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y')));
              ?>
            </ul>
          </div>
        </div>
    </div>
    <!-- Pagination /- -->
    </div>

    <!-- Property Listing Section /- -->
<?php
}

else {
?>
<div class="property-left col-md-9 col-sm-6 p_l_z content-area">
  <div class="alert alert-info"><?php echo TEXT_NO_PRODUCTS; ?></div>
</div>
<?php
}

?>
<?php include('advanced_search_box_right.php');?>
