<header id="header-section" class="header header1 container-fluid p_z">
  <!-- container -->
  <div class="container">
    <!-- Top Header -->
    <div class="top-header">
      <p class="col-md-6 col-sm-9">
        <span>
          <i class="fa fa-phone"></i>
          <?php
            echo STORE_PHONE;
            $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
          ?>
        </span>
        <span>
          <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?language=kh';?>" title="Khmer">
            <img src="includes/languages/khmer/images/icon.gif" style="width: 30px;border: none; "/>
          </a>
          <a href="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0] . '?language=en';?>" title="English">
            <img src="includes/languages/english/images/icon.gif" style="width: 30px;border: none; "/>
          </a>
        </span>
      </p>
      <div class="col-md-6 col-sm-3 p_r_z">

        <ul class="property-social p_l_z m_b_z">
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
                  <i class="fa fa-sign-in"></i>
                  <?php echo HEADER_TITLE_MY_ACCOUNT;?>
                </a>
              </li>
              <li>
                <a href="logoff.php">
                  <i class="fa fa-edit"></i>
                  <?php echo HEADER_TITLE_LOGOFF;?>
                </a>
              </li>
          <?php
            }
          ?>
          <li>
            <button class="btn">
              <a href="account.php#/manage_property/post" title="<?php echo POST_PROPERTY;?>">
                <?php echo POST_PROPERTY;?>
              </a>
            </button>
          </li>
        </ul>

      </div>
    </div><!-- Top Header -->
    <!-- Navigation Block -->
    <div class="navigation-block">
      <!-- Logo Block -->
      <div class="col-md-2 logo-block no-padding">
        <?php
        echo '<a href="' . tep_href_link('index.php') . '">
            <img src="' . DIR_WS_IMAGES . STORE_LOGO .'"  alt="logo" style="width: 100px;"/></a>';
        ?>
      </div><!-- Logo Block /- -->
      <!-- Menu Block -->
      <div class="col-md-10 menu-block">
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
              <?php 
                echo tep_get_categories_list();
              ?>
              <li>
                <a href="agents.php"><?php echo MENU_AGENTS; ?></a>
              </li>
              <li>
                <a href="news.php"><?php echo MENU_NEWS; ?></a>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </nav><!-- nav /- -->
      </div><!-- Menu Block /- -->
    </div><!-- Navigation Block /- -->
  </div><!-- container /- -->
</header><!-- Header Section /- -->