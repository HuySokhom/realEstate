<!-- START PAGE CONTAINER -->
<div class="page-container">
  <!-- START PAGE SIDEBAR -->
  <div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
      <li class="xn-logo">
        <a href="#/">Singa Property</a>
        <a href="#" class="x-navigation-control"></a>
      </li>
      <li class="xn-profile">
        <a href="#/" class="profile-mini">
          <img src="images/icons/ico.png" alt="Logo"/>
        </a>
        <div class="profile">
          <div class="profile-image">
            <img src="images/logo.png" alt="John Doe" style="background: #ffffff;"/>
          </div>
          <div class="profile-data">
            <div class="profile-data-name">
              <i class="fa fa-user"></i>
              <?php echo $admin['username'];?>
            </div>
          </div>
        </div>
      </li>
      <li class="active">
        <a href="#/"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Catalog</span></a>
        <ul>
          <li><a href="#/category"><span class="fa fa-code-fork"></span> Categories</a></li>
          <li><a href="#/product"><span class="fa fa-sitemap"></span> Products</a></li>
          <li><a href="#/user"><span class="fa fa-users"></span> Users</a></li>
          <li><a href="#/slider"><span class="fa fa-film"></span> Image Slider</a></li>
          <li>
            <a href="#/popular_location"><span class="fa fa-clock-o"></span> Popular Search</a>
          </li>
          <li>
            <a href="#/news"><span class="fa fa-dashboard"></span> News</a>
          </li>
          <li>
            <a href="#/news_type"><span class="fa fa-crop"></span> News Type</a>
          </li>
          <li><a href="#/content"><span class="fa fa-comments"></span>Content</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Configuration</span></a>
        <ul>
          <li><a href="administrators.php">Administrators</a></li>
          <li><a href="#/customer_plan">Customer Book Plan</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-map-marker"></span> <span class="xn-text">Location</span></a>
        <ul>
          <li><a href="#/location">Province</a></li>
          <li><a href="#/district">District</a></li>
          <li><a href="#/village">Village</a></li>
        </ul>
      </li>
    </ul>
    <!-- END X-NAVIGATION -->
  </div>
  <!-- END PAGE SIDEBAR -->
  <!-- PAGE CONTENT -->
  <div class="page-content">

    <!-- START X-NAVIGATION VERTICAL -->
    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
      <!-- TOGGLE NAVIGATION -->
      <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
      </li>
      <!-- END TOGGLE NAVIGATION -->
      <!-- SEARCH -->
      <li>
        <a href=" <?php echo tep_catalog_href_link(); ?>" target="_blank">
          <?php echo HEADER_TITLE_ONLINE_CATALOG ?>
        </a>
      </li>
      <!-- END SEARCH -->
      <!-- SIGN OUT -->
      <li class="xn-icon-button pull-right">
        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
      </li>
      <!-- END SIGN OUT -->
      <?php
        $queryExpiryday = tep_db_query("select count(*) as total from customers_plan where DAY(plan_expire) = DAY(NOW()) AND MONTH(plan_expire) = MONTH(NOW())");
        $countExpiryDay = tep_db_fetch_array($queryExpiryday);
      ?>
      <?php
      $queryBook = tep_db_query("select count(*) as total from customers_plan where DAY(create_date) = DAY(NOW()) AND MONTH(create_date) = MONTH(NOW()) AND YEAR(create_date) = YEAR(NOW()) ");
      $countBook = tep_db_fetch_array($queryBook);
      ?>
      <!-- MESSAGES -->
      <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-comments"></span></a>
        <div class="informer informer-danger"><?php echo $countExpiryDay['total'];?></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
            <div class="pull-right">
              <span class="label label-danger"><?php echo $countExpiryDay['total'];?></span>
            </div>
          </div>
          <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
            <a class="list-group-item" href="#/customer_expire">
              <strong>Customer Expire Plan</strong>
              <span class="label label-danger"><?php echo $countExpiryDay['total'];?></span>
            </a>
          </div>
          <div class="panel-footer text-center">
            <a href="#">Show all messages</a>
          </div>
        </div>
      </li>
      <!-- END MESSAGES -->
      <!-- TASKS -->
      <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-tasks"></span></a>
        <div class="informer informer-warning"><?php echo $countBook['total'];?></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>
            <div class="pull-right">
              <span class="label label-warning"><?php echo $countBook['total'];?> active</span>
            </div>
          </div>
          <div class="panel-body list-group scroll" style="height: 200px;">
            <a class="list-group-item" href="#/customer_plan">
              <strong>Customer Expire Plan</strong>
              <span class="label label-danger"><?php echo $countBook['total'];?></span>
            </a>
          </div>
          <div class="panel-footer text-center">
            <a href="#">Show all tasks</a>
          </div>
        </div>
      </li>
      <!-- END TASKS -->
    </ul>
    <!-- END X-NAVIGATION VERTICAL -->
