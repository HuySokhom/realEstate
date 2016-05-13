<nav class="navbar header-style navbar-inverse navbar-fixed-top" role="navigation" style="position: absolute;">
  <div class="container"  style="background: #069;">
    <div class="navbar-header">
      <button
          type="button"
          class="navbar-toggle collapsed"
          data-toggle="collapse"
          data-target="#navbar"
          style="background: #069;border: 0px;"
      >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
<!--      <a href="index.php">-->
<!--        <span style="text-shadow: 3px 4px 5px #777777;font-size: 30px;">-->
<!--          --><?php //echo STORE_NAME;?>
<!--        </span>-->
<!--      </a>-->
      <?php
        echo '<a href="' . tep_href_link('index.php') . '">
            <img src="' . DIR_WS_IMAGES . STORE_LOGO .'" style="width: 135px;" /></a>';
      ?>
    </div>
    <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
      <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="advanced_search.php">Advance Search</a>
          </li>
          <li>
            <a href="account.php#/index">Manage Ad</a>
          </li>
          <li class="dropdown">
            <?php
            if (tep_session_is_registered('customer_id')) {
              ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="fa fa-user"></span>
                <?php echo $_SESSION['user_name']?>
                <b class="caret"></b>
              </a>
              <?php
            }else{
              ?>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
              <?php
            }
            ?>
            <ul class="dropdown-menu">
              <?php
              if (tep_session_is_registered('customer_id')) {
                echo '<li><a href="' . tep_href_link(FILENAME_LOGOFF, '', 'SSL') . '">' . HEADER_ACCOUNT_LOGOFF . '</a>';
              }
              else {
                echo '<li><a href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . HEADER_ACCOUNT_LOGIN . '</a>';
                echo '<li><a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . HEADER_ACCOUNT_REGISTER . '</a>';
              }
              if(tep_session_is_registered('customer_id')){
                ?>
<!--                <li class="divider"></li>-->
<!--                <li>--><?php //echo '<a href="' . tep_href_link(FILENAME_ACCOUNT . '#/account', '', 'SSL') . '">' . HEADER_ACCOUNT . '</a>'; ?><!--</li>-->
<!--                <li>--><?php //echo '<a href="' . tep_href_link(FILENAME_ACCOUNT . '#/manage', '', 'SSL') . '">Post Ads</a>'; ?><!--</li>-->
                <?php
              }
              ?>
            </ul>
          </li>
      </ul>
      <div class="col-sm-4" style="float: right">
        <div class="searchbox-margin">
          <form name="quick_find"
                action="advanced_search_result.php"
                method="get"
                class="form-horizontal"
              >
            <div class="input-group">
              <input type="search" name="keywords" required="" placeholder="Search" class="form-control">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info"><i class="glyphicon glyphicon-search"></i></button></span>
            </div>
          </form>
        </div>
      </div>
    </div><!--/.nav-collapse -->
  </div><!--/.container-fluid -->
</nav>