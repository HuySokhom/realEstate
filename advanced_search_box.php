<?php

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

?>

<script src="includes/general.js"></script>
<script><!--
function check_form() {
  var error_message = "<?php echo JS_ERROR; ?>";
  var error_found = false;
  var error_field;
  var keywords = document.advanced_search.keywords.value;
  var dfrom = document.advanced_search.dfrom.value;
  var dto = document.advanced_search.dto.value;
  var pfrom = document.advanced_search.pfrom.value;
  var pto = document.advanced_search.pto.value;
  var pfrom_float;
  var pto_float;

  if ( ((keywords == '') || (keywords.length < 1)) && ((dfrom == '') || (dfrom.length < 1)) && ((dto == '') || (dto.length < 1)) && ((pfrom == '') || (pfrom.length < 1)) && ((pto == '') || (pto.length < 1)) ) {
    error_message = error_message + "* <?php echo ERROR_AT_LEAST_ONE_INPUT; ?>\n";
    error_field = document.advanced_search.keywords;
    error_found = true;
  }

  if (dfrom.length > 0) {
    if (!IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "* <?php echo ERROR_INVALID_FROM_DATE; ?>\n";
      error_field = document.advanced_search.dfrom;
      error_found = true;
    }
  }

  if (dto.length > 0) {
    if (!IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>')) {
      error_message = error_message + "* <?php echo ERROR_INVALID_TO_DATE; ?>\n";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if ((dfrom.length > 0) && (IsValidDate(dfrom, '<?php echo DOB_FORMAT_STRING; ?>')) && (dto.length > 0) && (IsValidDate(dto, '<?php echo DOB_FORMAT_STRING; ?>'))) {
    if (!CheckDateRange(document.advanced_search.dfrom, document.advanced_search.dto)) {
      error_message = error_message + "* <?php echo ERROR_TO_DATE_LESS_THAN_FROM_DATE; ?>\n";
      error_field = document.advanced_search.dto;
      error_found = true;
    }
  }

  if (pfrom.length > 0) {
    pfrom_float = parseFloat(pfrom);
    if (isNaN(pfrom_float)) {
      error_message = error_message + "* <?php echo ERROR_PRICE_FROM_MUST_BE_NUM; ?>\n";
      error_field = document.advanced_search.pfrom;
      error_found = true;
    }
  } else {
    pfrom_float = 0;
  }

  if (pto.length > 0) {
    pto_float = parseFloat(pto);
    if (isNaN(pto_float)) {
      error_message = error_message + "* <?php echo ERROR_PRICE_TO_MUST_BE_NUM; ?>\n";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  } else {
    pto_float = 0;
  }

  if ( (pfrom.length > 0) && (pto.length > 0) ) {
    if ( (!isNaN(pfrom_float)) && (!isNaN(pto_float)) && (pto_float < pfrom_float) ) {
      error_message = error_message + "* <?php echo ERROR_PRICE_TO_LESS_THAN_PRICE_FROM; ?>\n";
      error_field = document.advanced_search.pto;
      error_found = true;
    }
  }

  if (error_found == true) {
    alert(error_message);
    error_field.focus();
    return false;
  } else {
    return true;
  }
}
//--></script>

<?php
  if ($messageStack->size('search') > 0) {
    //echo $messageStack->output('search');
  }
?>

<?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'class="form-horizontal" onsubmit="return check_form(this);"') . tep_hide_session_id(); ?>

<div class="clearfix" style="padding-top: 20px;background-color: #f2f4f5;">

  <div class="container">
    <div class="col-md-10">

      <div class="col-md-3 search">
        <?php
        echo tep_draw_input_field('keywords', '', 'required aria-required="true" id="inputKeywords" placeholder="' . SEARCH . '"', 'search');
        echo FORM_REQUIRED_INPUT;
        echo tep_draw_hidden_field('search_in_description', '1');
        ?>
      </div>

      <div class="col-md-3 search">
        <?php
          echo tep_draw_pull_down_menu(
              'categories_id',
              tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES))),
              NULL,
              'id="entryCategories" class="form-control"'
          );
        ?>
      </div>

      <div class="col-md-3 search">
        <select
            name="kind_of"
            class="form-control"
            id="kind_of"
        >
          <option value="" selected="selected"><?php echo TEXT_ALL_MANUFACTURERS;?></option>
          <option value="For Sale">For Sale</option>
          <option value="For Rent">For Rent</option>
          <option value="Both Sale and Rent">Both Sale and Rent</option>
        </select>
      </div>

      <div class="col-md-3 search">
        <?php
        echo tep_draw_input_field('pfrom', '', 'id="PriceFrom" placeholder="' . ENTRY_PRICE_FROM . '"');
        ?>
      </div>

      <div class="col-md-3 search">
        <?php
        echo tep_draw_input_field('pto', '', 'id="PriceTo" placeholder="' . ENTRY_PRICE_TO . '"');
        ?>
      </div>

      <div class="col-md-3 search">
        <?php
        echo tep_draw_input_field('bfrom', '', 'id="bfrom" placeholder="' . ENTRY_BED_FROM . '"');
        ?>
      </div>

      <div class="col-md-3 search">
        <?php
        echo tep_draw_input_field('bto', '', 'id="bto" placeholder="' . ENTRY_BED_TO . '"');
        ?>
      </div>

      <div class="col-md-3 search">
        <?php
          echo tep_draw_pull_down_menu(
              'location',
              tep_get_province(array(array('id' => '', 'text' => POPULAR_LOCATION))),
              NULL,
              'id="location" class="form-control"'
          );
        ?>
      </div>
  </div>

    <!-- col-md-2 -->
    <div class="col-md-2 col-sm-3">
      <div class="section-header">
        <h3><span><?php echo SEARCH; ?></span><?php echo PROPERTY; ?></h3>
        <?php echo tep_draw_button(SEARCH, 'fa fa-search', null, 'primary', null, 'btn-success'); ?>
      </div>
    </div>
    <div class="popular-search"></div>
    <!-- col-md-2
    <div class="clearfix">
      <div class="popular-search">
          <span class="search_text">
            Popular search
          </span>
          <span class="first">
            <i class="fa fa-hand-o-right"></i>
            <a href="advanced_search_result.php?keywords=&search_in_description=1&categories_id=&kind_of=&pfrom=&pto=&bfrom=&bto=&location=3">Siem Reap</a>
          </span>
          <span>
            <i class="fa fa-hand-o-right"></i>
            <a href="javascript:void(0)">Sihanouk</a>
          </span>
          <span>
            <i class="fa fa-hand-o-right"></i>
            <a href="javascript:void(0)">Beoung Kangkong 1</a>
          </span>
          <span>
            <i class="fa fa-hand-o-right"></i>
            <a href="javascript:void(0)">Tonle Bassac</a>
          </span>
        <spani>
          <i class="fa fa-hand-o-right"></i>
          <a href="javascript:void(0)">Toul Tum Poung</a>
        </spani>
          <span>
            <i class="fa fa-hand-o-right"></i>
            <a href="javascript:void(0)">Toul Kork</a>
          </span>
          <span>
            <i class="fa fa-hand-o-right"></i>
            <a href="javascript:void(0)">Chamkarmom</a>
          </span>
      </div>
    </div>
    /- -->
  </div>
</div>

</form>
<div class="clearfix"></div>