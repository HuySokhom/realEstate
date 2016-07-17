<div class="create-account-link <?php echo (MODULE_CONTENT_CREATE_ACCOUNT_LINK_CONTENT_WIDTH == 'Half') ? 'col-sm-6' : 'col-sm-12'; ?>">
  <div class="panel panel-default">
    <div class="panel-body">
      <h4><?php echo MODULE_CONTENT_LOGIN_HEADING_NEW_CUSTOMER; ?></h4>
      <p>
        <i class="fa fa-hand-o-right"></i>
        <?php echo MODULE_CONTENT_JOIN_FREE; ?>
      <p>
        <i class="fa fa-hand-o-right"></i>
        <?php echo MODULE_CONTENT_SELL_OR_RENT; ?>
      </p>
      <p>
        <i class="fa fa-hand-o-right"></i>
        <?php echo MODULE_CONTENT_EASY_MANAGE; ?>
      </p>
      <p class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_REGISTER, 'fa fa-registered', tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), null, null, 'btn-primary btn-block'); ?></p>
    </div>
  </div>
</div>
