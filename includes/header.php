<header id="header-section" class="header header1 container-fluid p_z">
  <!-- container -->
  <div>
    <!-- Top Header -->
    <div class="top-header">
      <div class="container">
      <p class="col-md-3 col-sm-3">
        <?php
          $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        ?>
        <span>
          <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?language=kh';?>" title="Khmer">
            <img src="includes/languages/khmer/images/icon.gif" style="width: 30px;border: none; "/>
          </a>
          <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?language=en';?>" title="English">
            <img src="includes/languages/english/images/icon.gif" style="width: 30px;border: none; "/>
          </a>
        </span>
      </p>
      <div class="col-md-9 col-sm-9 p_r_z">
        <ul class="property-social p_l_z m_b_z">
          <li style="margin-right: -30px;">
            <div class="fb-like" data-href="https://facebook.com/skwebsolution/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
          </li>
          <?php //var_dump($_SESSION);
            if( !$_SESSION['user_name'] ){
          ?>
          <li>
            <a href="login.php">
              <i class="fa fa-sign-in"></i>
              <?php echo LOGIN;?>
            </a>
          </li>
          <li>
            <a href="create_account.php">
              <i class="fa fa-edit"></i>
              <?php echo REGISTER;?>
            </a>
          </li>
          <?php
            }else{
          ?>
              <li>
                <a href="account.php#/account">
                  <i class="fa fa-user"></i>
                  <?php echo HEADER_TITLE_MY_ACCOUNT;?>
                </a>
              </li>
              <li>
                <a href="logoff.php">
                  <i class="fa fa-sign-out"></i>
                  <?php echo HEADER_TITLE_LOGOFF;?>
                </a>
              </li>
          <?php
            }
          ?>
          <li>
            <a href="favorite.php">
              <i class="fa fa-heart"></i>
              <?php echo HEADER_FAVORITE;?>
            </a>
          </li>
          <li>
            <a href="account.php#/manage_property/post" title="<?php echo POST_PROPERTY;?>">
              <button class="btn" style="background: crimson;border: crimson;">
                <i class="fa fa-cloud-upload"></i>
                <?php echo POST_PROPERTY;?>
              </button>
            </a>
          </li>
        </ul>
      </div>
      </div>
    </div><!-- Top Header -->
    <!-- Navigation Block -->

    <div class="navigation-block">
      <div class="container">
      <!-- Logo Block -->
      <div class="col-md-2 logo-block no-padding">
        <?php
        echo '<a href="' . tep_href_link('index.php') . '">
            <img src="' . DIR_WS_IMAGES . STORE_LOGO .'"  alt="logo" style="width: 125px;"/></a>';
        ?>
      </div><!-- Logo Block /- -->
      <!-- Menu Block -->
      <div class="col-md-10 menu-block" style="padding-top: 10px;">
        <!-- nav -->
        <nav class="navbar navbar-default primary-navigation">
          <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse" id="navbar">
            <ul class="nav navbar-nav">
              <li>
                <a href="index.php"><?php echo HOME;?></a>
              </li>
              <li class="dropdown">
                <a href="javascript:;"><?php echo TEXT_BUY; ?></a>
                <ul class="dropdown-menu" role="menu">
                  <?php
                  echo tep_get_categories_list();
                  ?>
                </ul>
              </li>
              <li class="dropdown">
                <a href="javascript:;"><?php echo TEXT_RENT; ?></a>
                <ul class="dropdown-menu" role="menu">
                  <?php
                    echo tep_get_categories_list();
                  ?>
                </ul>
              </li>
              <li>
                <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=1');?>">
                  <?php echo TEXT_PUBLICATION;?>
                </a>
              </li>
              <li>
                <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=2');?>">
                  <?php echo TEXT_COMMUNITY;?>
                </a>
              </li>
              <li>
                <a href="agents.php"><?php echo MENU_AGENTS; ?></a>
              </li>
              <li>
                <a href="news.php"><?php echo MENU_NEWS; ?></a>
              </li>
              <li class="dropdown">
                <a href="javascript:;">
                  <?php echo TEXT_OTHER;?>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=3');?>">
                      <?php echo TEXT_SERVICE;?>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=4');?>">
                      <?php echo TEXT_LINK;?>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=5');?>">
                      <?php echo TEXT_GUIDE;?>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=6');?>">
                      <?php echo TEXT_ABOUT_US;?>
                    </a>
                  </li>
                  <li>
                    <a href="<?php echo tep_href_link(FILENAME_PAGES, 'pages_id=7');?>">
                      <?php echo TEXT_CONTACT_US;?>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </nav><!-- nav /- -->
      </div><!-- Menu Block /- -->
      </div>
    </div><!-- Navigation Block /- -->
  </div><!-- container /- -->
</header><!-- Header Section /- -->