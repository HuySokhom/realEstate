<div class="login-form col-md-12 col-sm-6">
  <div class="panel panel-default">
    <div class="panel-body">
      <h4><?php echo MODULE_CONTENT_LOGIN_HEADING_RETURNING_CUSTOMER; ?></h4>
      <?php echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', '', true); ?>

        <div class="form-group">
          <?php echo tep_draw_input_field('email_address', NULL, 'autofocus="autofocus" required id="inputEmail" placeholder="' . ENTRY_EMAIL_ADDRESS . '"', 'email'); ?>
        </div>

        <div class="form-group">
          <?php echo tep_draw_password_field('password', NULL, 'required aria-required="true" id="inputPassword" placeholder="' . ENTRY_PASSWORD . '"'); ?>
        </div>

        <p class="text-right"><?php echo tep_draw_button(IMAGE_BUTTON_LOGIN, 'fa fa-sign-in', null, 'primary', NULL, 'btn-success btn-block'); ?></p>

      </form>
      <a href="password_forgotten.php">
        <i class="fa fa-hand-o-right"></i>
        <?php echo MODULE_CONTENT_LOGIN_TEXT_PASSWORD_FORGOTTEN; ?>
      </a>
    </div>
  </div>
</div>
