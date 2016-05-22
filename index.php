<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $categories_products = tep_db_fetch_array($categories_products_query);
    if ($categories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);

  require(DIR_WS_INCLUDES . 'template_top.php');
?>
<div class="">

<?php
  if ($category_depth == 'nested') {
    $category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
    $category = tep_db_fetch_array($category_query);
?>

<div class="page-header">
  <h1><?php echo $category['categories_name']; ?></h1>
</div>

<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>

<div class="contentContainer">
  <div class="contentText">
    <div class="row">
<?php
    if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
      $category_links = array_reverse($cPath_array);
      for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $categories = tep_db_fetch_array($categories_query);
        if ($categories['total'] < 1) {
          // do nothing, go through the loop
        } else {
          $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
          break; // we've found the deepest category the customer is in
        }
      }
    } else {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
    }

    while ($categories = tep_db_fetch_array($categories_query)) {
      $cPath_new = tep_get_path($categories['categories_id']);
      echo '<div class="col-xs-6 col-sm-4">';
      echo '  <div class="text-center">';
      echo '    <a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . tep_image(DIR_WS_IMAGES . $categories['categories_image'], $categories['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT) . '</a>';
      echo '    <div class="caption text-center">';
      echo '      <h5><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . $categories['categories_name'] . '</a></h5>';
      echo '    </div>';
      echo '  </div>';
      echo '</div>';
    }

// needed for the new products module shown below
    $new_products_category_id = $current_category_id;
?>
      </div>

    <br />

<?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?>

  </div>
</div>

<?php
  } elseif ($category_depth == 'products' || (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id']))) {
// create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                         'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                         'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                         'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                         'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                         'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                         'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
                         'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW);

    asort($define_list);

    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
      if ($value > 0) $column_list[] = $key;
    }

    $select_column_list = '';

    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'PRODUCT_LIST_MODEL':
          $select_column_list .= 'p.products_model, ';
          break;
        case 'PRODUCT_LIST_NAME':
          $select_column_list .= 'pd.products_name, ';
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $select_column_list .= 'm.manufacturers_name, ';
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $select_column_list .= 'p.products_quantity, ';
          break;
        case 'PRODUCT_LIST_IMAGE':
          $select_column_list .= 'p.products_image, ';
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $select_column_list .= 'p.products_weight, ';
          break;
      }
    }

// show the products of a specified manufacturer
    if (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id'])) {
      if (isset($HTTP_GET_VARS['filter_id']) && tep_not_null($HTTP_GET_VARS['filter_id'])) {
// We are asked to show only a specific category
        $listing_sql = "select " . $select_column_list . " p.products_image_thumbnail, p.products_id , pd.products_viewed,
        SUBSTRING_INDEX(pd.products_description, '', 20) as products_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$HTTP_GET_VARS['filter_id'] . "'";
      } else {
// We show them all
        $listing_sql = "select " . $select_column_list . " p.products_image_thumbnail,pd.products_viewed, p.products_id, SUBSTRING_INDEX
        (pd.products_description, ' ', 20) as products_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'";
      }
    } else {
// show the products in a given categorie
      if (isset($HTTP_GET_VARS['filter_id']) && tep_not_null($HTTP_GET_VARS['filter_id'])) {
// We are asked to show only specific catgeory
        $listing_sql = "select " . $select_column_list . "pd.products_viewed, p.products_image_thumbnail, p.products_id, SUBSTRING_INDEX(pd.products_description, ' ', 20) as products_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$HTTP_GET_VARS['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
      } else {
// We show them all
        $listing_sql = "select " . $select_column_list . " pd.products_viewed, p.products_image_thumbnail, p.products_id, SUBSTRING_INDEX(pd.products_description, ' ', 20) as products_description, p.manufacturers_id, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
      }
    }

    if ( (!isset($HTTP_GET_VARS['sort'])) || (!preg_match('/^[1-8][ad]$/', $HTTP_GET_VARS['sort'])) || (substr($HTTP_GET_VARS['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
          $HTTP_GET_VARS['sort'] = $i+1 . 'a';
          $listing_sql .= " order by p.products_date_added desc";
          break;
        }
      }
    } else {
      $sort_col = substr($HTTP_GET_VARS['sort'], 0 , 1);
      $sort_order = substr($HTTP_GET_VARS['sort'], 1);

      switch ($column_list[$sort_col-1]) {
        case 'PRODUCT_LIST_MODEL':
          $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_NAME':
          $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $listing_sql .= " order by m.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_IMAGE':
          $listing_sql .= " order by pd.products_name";
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_PRICE':
          $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
      }
    }

    $catname = HEADING_TITLE;
    if (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id'])) {
      $image = tep_db_query("select manufacturers_image, manufacturers_name as catname from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
      $image = tep_db_fetch_array($image);
      $catname = $image['catname'];
    } elseif ($current_category_id) {
      $image = tep_db_query("select c.categories_image, cd.categories_name as catname from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
      $image = tep_db_fetch_array($image);
      $catname = $image['catname'];
    }
?>

<div class="page-header">
<!--  <h1>--><?php //echo $catname; ?><!--</h1>-->
</div>

<div class="contentContainer">

<?php
// optional Product List Filter
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
      $filterlist_query = tep_db_query($filterlist_sql);
      if (tep_db_num_rows($filterlist_query) > 1) {
        echo '<div>' . tep_draw_form('filter', FILENAME_DEFAULT, 'get') . '<p align="right">' . TEXT_SHOW . '&nbsp;';
        if (isset($HTTP_GET_VARS['manufacturers_id']) && !empty($HTTP_GET_VARS['manufacturers_id'])) {
          echo tep_draw_hidden_field('manufacturers_id', $HTTP_GET_VARS['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          echo tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo tep_draw_hidden_field('sort', $HTTP_GET_VARS['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        echo tep_draw_pull_down_menu('filter_id', $options, (isset($HTTP_GET_VARS['filter_id']) ? $HTTP_GET_VARS['filter_id'] : ''), 'onchange="this.form.submit()"');
        echo tep_hide_session_id() . '</p></form></div>' . "\n";
      }
    }

    //include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
?>
  <!-- Property Listing Section -->
  <div id="property-listing" class="property-listing">
    <div class="container">
      <div class="property-left col-md-9 col-sm-6 p_l_z content-area">
        <div class="section-header p_l_z">
          <div class="col-md-10 col-sm-10 p_l_z">
            <p>property</p>
            <h3>listing</h3>
          </div>
          <div class="view-list col-md-2 col-sm-2 p_r_z">
            <a title="Grid View" href="aa-listing.html"><i class="fa fa-th "></i></a>
            <a class="active" title="List View" href="aa-listing-list.html"><i class="fa fa-bars"></i></a>
          </div>
        </div>

        <div class="property-listing-box sale-block">
          <!-- Property Main Box -->
          <div class="property-main-box">
            <div class="col-md-4 p_z">
              <a title="Property Image" href="aa-listing-list.html#"><img src="images/aa-listing/property1.jpg" alt="property1"></a>
            </div>
            <div class="col-md-8 p_z">
              <div class="property-details">
                <span>s</span>
                <a title="Property Title" href="aa-listing-list.html#">15 Apartments of Type B </a>
                <h4>&dollar;330000 </h4>
                <p>Our Latest listed properties and check out the facnd check out the facilities on them.</p>
                <ul>
                  <li><i class="fa fa-expand"></i> 3326 sq </li>
                  <li><img src="images/aa-listing/bedroom-icon.png" alt="bedroom-icon"> 3 </li>
                  <li><img src="images/aa-listing/bathroom-icon.png" alt="bathroom-icon">2 </li>
                  <li><i class="fa fa-car"></i>1</li>
                </ul>
              </div>
            </div>
          </div><!-- Property Main Box /- -->
        </div>
        <div class="property-listing-box rent-block">
          <!-- Property Main Box -->
          <div class="property-main-box">
            <div class="col-md-4 p_z ">
              <a title="Property Image" href="aa-listing-list.html#"><img src="images/aa-listing/property2.jpg" alt="property2"></a>
            </div>
            <div class="col-md-8 p_z">
              <div class="property-details">
                <span>r</span>
                <a title="Property Title" href="aa-listing-list.html#">15 Apartments of Type B </a>
                <h4>&dollar;320/mo</h4>
                <p>Our Latest listed properties and check out the facnd check out the facilities on them.</p>
                <ul>
                  <li><i class="fa fa-expand"></i> 3326 sq </li>
                  <li><img src="images/icon/bed-icon.png" alt="bedroom-icon"> 3 </li>
                  <li><img src="images/icon/bath-icon.png" alt="bathroom-icon">2 </li>
                  <li><i class="fa fa-car"></i>1</li>
                </ul>
              </div>
            </div>
          </div><!-- Property Main Box /- -->
        </div>
        <div class="property-listing-box sale-block">
          <!-- Property Main Box -->
          <div class="property-main-box">
            <div class="col-md-4 p_z">
              <a title="Property Image" href="aa-listing-list.html#"><img src="images/aa-listing/property3.jpg" alt="property1"></a>
            </div>
            <div class="col-md-8 p_z">
              <div class="property-details">
                <span>s</span>
                <a title="Property Title" href="aa-listing-list.html#">15 Apartments of Type B </a>
                <h4>&dollar;330000 </h4>
                <p>Our Latest listed properties and check out the facnd check out the facilities on them.</p>
                <ul>
                  <li><i class="fa fa-expand"></i> 3326 sq </li>
                  <li><img src="images/aa-listing/bedroom-icon.png" alt="bedroom-icon"> 3 </li>
                  <li><img src="images/aa-listing/bathroom-icon.png" alt="bathroom-icon">2 </li>
                  <li><i class="fa fa-car"></i>1</li>
                </ul>
              </div>
            </div>
          </div><!-- Property Main Box /- -->
        </div>
        <div class="property-listing-box rent-block">
          <!-- Property Main Box -->
          <div class="property-main-box">
            <div class="col-md-4 p_z ">
              <a title="Property Image" href="aa-listing-list.html#"><img src="images/aa-listing/property4.jpg" alt="property2"></a>
            </div>
            <div class="col-md-8 p_z">
              <div class="property-details">
                <span>r</span>
                <a title="Property Title" href="aa-listing-list.html#">15 Apartments of Type B </a>
                <h4>&dollar;320/mo</h4>
                <p>Our Latest listed properties and check out the facnd check out the facilities on them.</p>
                <ul>
                  <li><i class="fa fa-expand"></i> 3326 sq </li>
                  <li><img src="images/icon/bed-icon.png" alt="bedroom-icon"> 3 </li>
                  <li><img src="images/icon/bath-icon.png" alt="bathroom-icon">2 </li>
                  <li><i class="fa fa-car"></i>1</li>
                </ul>
              </div>
            </div>
          </div><!-- Property Main Box /- -->
        </div>
        <div class="property-listing-box sale-block">
          <!-- Property Main Box -->
          <div class="property-main-box">
            <div class="col-md-4 p_z">
              <a title="Property Image" href="aa-listing-list.html#"><img src="images/aa-listing/property5.jpg" alt="property1"></a>
            </div>
            <div class="col-md-8 p_z">
              <div class="property-details">
                <span>s</span>
                <a title="Property Title" href="aa-listing-list.html#">15 Apartments of Type B </a>
                <h4>&dollar;330000 </h4>
                <p>Our Latest listed properties and check out the facnd check out the facilities on them.</p>
                <ul>
                  <li><i class="fa fa-expand"></i> 3326 sq </li>
                  <li><img src="images/aa-listing/bedroom-icon.png" alt="bedroom-icon"> 3 </li>
                  <li><img src="images/aa-listing/bathroom-icon.png" alt="bathroom-icon">2 </li>
                  <li><i class="fa fa-car"></i>1</li>
                </ul>
              </div>
            </div>
          </div><!-- Property Main Box -->
        </div>
        <div class="property-listing-box rent-block">
          <!-- Property Main Box -->
          <div class="property-main-box">
            <div class="col-md-4 p_z ">
              <a title="Property Image" href="aa-listing-list.html#"><img src="images/aa-listing/property4.jpg" alt="property2"></a>
            </div>
            <div class="col-md-8 p_z">
              <div class="property-details">
                <span>r</span>
                <a title="Property Title" href="aa-listing-list.html#">15 Apartments of Type B </a>
                <h4>&dollar;320/mo</h4>
                <p>Our Latest listed properties and check out the facnd check out the facilities on them.</p>
                <ul>
                  <li><i class="fa fa-expand"></i> 3326 sq </li>
                  <li><img src="images/icon/bed-icon.png" alt="bedroom-icon"> 3 </li>
                  <li><img src="images/icon/bath-icon.png" alt="bathroom-icon">2 </li>
                  <li><i class="fa fa-car"></i>1</li>
                </ul>
              </div>
            </div>
          </div><!-- Property Main Box /- -->
        </div>
        <!-- Pagination -->
        <div class="listing-pagination">
          <ul class="pagination">
            <li class="active"><a href="aa-listing-list.html#">1</a></li>
            <li><a href="aa-listing-list.html#">2</a></li>
            <li><a href="aa-listing-list.html#">3</a></li>
          </ul>
        </div><!-- Pagination /- -->
      </div>
      <div class="col-md-3 col-sm-6 p_r_z property-sidebar widget-area">
        <aside class="widget widget-search">
          <h2 class="widget-title">search<span>property</span></h2>
          <form>
            <select>
              <option value="selected">Property ID</option>
              <option value="one">One</option>
              <option value="two">Two</option>
              <option value="three">Three</option>
              <option value="four">Four</option>
              <option value="five">Five</option>
            </select>
            <select>
              <option value="selected">Location</option>
              <option value="one">One</option>
              <option value="two">Two</option>
              <option value="three">Three</option>
              <option value="four">Four</option>
              <option value="five">Five</option>
            </select>
            <select>
              <option value="selected">Type</option>
              <option value="one">One</option>
              <option value="two">Two</option>
              <option value="three">Three</option>
              <option value="four">Four</option>
              <option value="five">Five</option>
            </select>
            <select>
              <option value="selected">Status</option>
              <option value="one">One</option>
              <option value="two">Two</option>
              <option value="three">Three</option>
              <option value="four">Four</option>
              <option value="five">Five</option>
            </select>
            <div class="col-md-6 col-sm-6 p_l_z">
              <select>
                <option value="selected">Beds</option>
                <option value="one">One</option>
                <option value="two">Two</option>
                <option value="three">Three</option>
                <option value="four">Four</option>
                <option value="five">Five</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-6 p_r_z">
              <select>
                <option value="selected">Baths</option>
                <option value="one">One</option>
                <option value="two">Two</option>
                <option value="three">Three</option>
                <option value="four">Four</option>
                <option value="five">Five</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-6 p_l_z">
              <select>
                <option value="selected">Min Price</option>
                <option value="one">One</option>
                <option value="two">Two</option>
                <option value="three">Three</option>
                <option value="four">Four</option>
                <option value="five">Five</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-6 p_r_z">
              <select>
                <option value="selected">Max Price</option>
                <option value="one">$3000</option>
                <option value="two">$30000</option>
                <option value="three">$300000</option>
                <option value="four">$3000000</option>
                <option value="five">$3000000000000000</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-6 p_l_z">
              <select>
                <option value="selected">Min Sqft</option>
                <option value="one">One</option>
                <option value="two">Two</option>
                <option value="three">Three</option>
                <option value="four">Four</option>
                <option value="five">Five</option>
              </select>
            </div>
            <div class="col-md-6 col-sm-6 p_r_z">
              <select>
                <option value="selected">Max Sqft</option>
                <option value="one">One</option>
                <option value="two">Two</option>
                <option value="three">Three</option>
                <option value="four">Four</option>
                <option value="five">Five</option>
              </select>
            </div>
            <input type="submit" value="Search Now" class="btn">
          </form>
        </aside>

      </div>
    </div>
  </div><!-- Property Listing Section /- -->

</div>

<?php
  } else { // default page
?>

<?php
  if ($messageStack->size('product_action') > 0) {
    echo $messageStack->output('product_action');
  }
?>

<!-- Search Section -->
<?php
  include('advanced_search_box.php');
?>
<!-- Search Section /- -->

<div class="container">
<?php
    if (tep_not_null(TEXT_MAIN)) {
?>

  <div class="contentText">
    <?php echo TEXT_MAIN; ?>
  </div>

<?php
    }

    //include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS);
//    include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS);
?>
  <br/><br/>
  <!-- Rent Property -->
  <div class="rent-property">
    <div class="col-md-3">
      <div class="section-header">
        <h3><span>Property</span>For Rent</h3>
        <p>Our Latest listed properties and check out the facilities on them.</p>
      </div>
    </div>
    <div class="col-md-9 p_r_z">
      <div id="rent-property-block" class="rent-property-block">
        <div class="item">
          <!-- col-md-12 -->
          <div class="col-md-12 rent-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-1.jpg" alt="rent" /></a>
                <h4>&dollar;380 / pm</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">Southwest 39th Terrace</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div><!-- col-md-12 /- -->
        </div>

        <div class="item">
          <!-- Col-md-12 -->
          <div class="col-md-12 rent-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-2.jpg" alt="rent" /></a>
                <h4>&dollar;380 / pm</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">20 Apartments of Type A</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box -->
          </div><!-- Col-md-12 /- -->
        </div>

        <div class="item">
          <!-- col-md-12 -->
          <div class="col-md-12 rent-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-3.jpg" alt="rent" /></a>
                <h4>&dollar;380 / pm</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">15 Apartments of Type B</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div>
        </div>

        <div class="item">
          <!-- col-md-12 -->
          <div class="col-md-12 rent-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-1.jpg" alt="rent" /></a>
                <h4>&dollar;380 / pm</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">Southwest 39th Terrace</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div><!-- Property Main Box /- -->
        </div>
      </div>
    </div>
  </div><!-- Rent Property /- -->
  <div class="clearfix"></div>
  <!-- Sale Property -->
  <div class="sale-property">
    <div class="col-md-3">
      <div class="section-header">
        <h3><span>Property</span>For Sale</h3>
        <p>Our Latest listed properties and check out the facilities on them.</p>
      </div>
    </div>
    <div class="col-md-9 p_r_z">
      <div id="sale-property-block" class="sale-property-block">
        <div class="item">
          <!-- col-md-12 -->
          <div class="col-md-12 sale-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-1.jpg" alt="rent" /></a>
                <h4>&dollar;380000</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">Southwest 39th Terrace</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div><!-- Col-md-12 /- -->
        </div>

        <div class="item">
          <!-- Col-md-12 -->
          <div class="col-md-12 sale-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-2.jpg" alt="rent" /></a>
                <h4>&dollar;330000</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">20 Apartments of Type A</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div><!-- Col-md-12 /- -->
        </div>

        <div class="item">
          <!-- Col-md-12 -->
          <div class="col-md-12 sale-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-3.jpg" alt="rent" /></a>
                <h4>&dollar;350000</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">15 Apartments of Type B</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box -->
          </div><!-- col-md-12 -->
        </div>

        <div class="item">
          <!-- col-md-12 -->
          <div class="col-md-12 sale-block">
            <!-- Property Main Box -->
            <div class="property-main-box">
              <div class="property-images-box">
                <a title="Property Image" href="index.html#"><img src="images/rent/rent-1.jpg" alt="rent" /></a>
                <h4>&dollar;380 / pm</h4>
              </div>
              <div class="clearfix"></div>
              <div class="property-details">
                <a title="Property Title" href="index.html#">Southwest 39th Terrace</a>
                <ul>
                  <li><i class="fa fa-expand"></i>3326 sq</li>
                  <li><i><img src="images/icon/bed-icon.png" alt="bed-icon" /></i>3</li>
                  <li><i><img src="images/icon/bath-icon.png" alt="bath-icon" /></i>2</li>
                </ul>
              </div>
            </div><!-- Property Main Box /- -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  }

  require(DIR_WS_INCLUDES . 'template_bottom.php');
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
