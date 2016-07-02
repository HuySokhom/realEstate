<div class="col-md-3 col-sm-6 p_r_z property-sidebar widget-area">
  <aside class="widget widget-search">
    <h2 class="widget-title">
      <?php echo TEXT_SEARCH;?>
      <span>
        <?php echo PROPERTY;?>
      </span></h2>
    <form>
      <?php
        echo tep_draw_pull_down_menu(
            'categories_id',
            tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES))),
            NULL,
            'id="entryCategories"');
      ?>
      <?php
        echo tep_draw_pull_down_menu(
            'location_id',
            tep_get_province(array(array('2id' => '', 'text' => TEXT_ALL_LOCATION))),
            NULL,
            'id="province"'
        );
      ?>
      <select name="type">
        <option value="selected"><?php echo TEXT_TYPE;?></option>
        <option value="For Rent">For Rent</option>
        <option value="For Sale">For Sale</option>
        <option value="Both Sale and Rent">Both Sale and Rent</option>
      </select>
      <div class="col-md-6 col-sm-6 p_l_z" name="bed_from">
        <select>
          <option value="selected">Beds</option>
          <option value="one">One</option>
          <option value="two">Two</option>
          <option value="three">Three</option>
          <option value="four">Four</option>
          <option value="five">Five</option>
        </select>
      </div>
      <div class="col-md-6 col-sm-6 p_r_z" name="bed_to">
        <select>
          <option value="selected">Baths</option>
          <option value="one">One</option>
          <option value="two">Two</option>
          <option value="three">Three</option>
          <option value="four">Four</option>
          <option value="five">Five</option>
        </select>
      </div>
      <div class="col-md-6 col-sm-6 p_l_z" name="price_from">
        <select>
          <option value="selected">Min Price</option>
          <option value="one">One</option>
          <option value="two">Two</option>
          <option value="three">Three</option>
          <option value="four">Four</option>
          <option value="five">Five</option>
        </select>
      </div>
      <div class="col-md-6 col-sm-6 p_r_z" name="price_to">
        <select>
          <option value="selected">Max Price</option>
          <option value="one">$3000</option>
          <option value="two">$30000</option>
          <option value="three">$300000</option>
          <option value="four">$3000000</option>
          <option value="five">$3000000000000000</option>
        </select>
      </div>

      <input type="submit" value="Search Now" class="btn">
    </form>
  </aside>

</div>