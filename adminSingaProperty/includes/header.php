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
          <li class="xn-openable">
            <a href="#"><span class="fa fa-map-marker"></span> Location</a>
            <ul>
              <li><a href="#/location">Province</a></li>
              <li><a href="#/district">District</a></li>
              <li><a href="#/village">Village</a></li>
            </ul>
          </li>
          <li>
            <a href="#/popular_location"><span class="fa fa-clock-o"></span> Popular Search</a>
          </li>
          <li>
            <a href="#/news"><span class="fa fa-dashboard"></span> News</a>
          </li>
          <li>
            <a href="#/news_type"><span class="fa fa-crop"></span> News Type</a>
          </li>
          <li><a href="#/products_attributes"><span class="fa fa-comments"></span> Products Attributes</a></li>
          <li><a href="#/products_expected"><span class="fa fa-calendar"></span> Products Expected</a></li>
          <li><a href="#/reviews"><span class="fa fa-edit"></span> Reviews</a></li>
          <li><a href="#/specials"><span class="fa fa-columns"></span> Specials</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Configuration</span></a>
        <ul>
          <li><a href="administrators.php">Administrators</a></li>
          <li><a href="layout-nav-toggled.html">Navigation Toggled</a></li>
          <li><a href="layout-nav-top.html">Navigation Top</a></li>
          <li><a href="layout-nav-right.html">Navigation Right</a></li>
          <li><a href="layout-nav-top-fixed.html">Top Navigation Fixed</a></li>
          <li><a href="layout-nav-custom.html">Custom Navigation</a></li>
          <li><a href="layout-frame-left.html">Frame Left Column</a></li>
          <li><a href="layout-frame-right.html">Frame Right Column</a></li>
          <li><a href="layout-search-left.html">Search Left Side</a></li>
          <li><a href="blank.html">Blank Page</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Localization</span></a>
        <ul>
          <li><a href="ui-widgets.html"><span class="fa fa-heart"></span> Widgets</a></li>
          <li><a href="ui-elements.html"><span class="fa fa-cogs"></span> Elements</a></li>
          <li><a href="ui-buttons.html"><span class="fa fa-square-o"></span> Buttons</a></li>
          <li><a href="ui-panels.html"><span class="fa fa-pencil-square-o"></span> Panels</a></li>
          <li><a href="ui-icons.html"><span class="fa fa-magic"></span> Icons</a><div class="informer informer-warning">+679</div></li>
          <li><a href="ui-typography.html"><span class="fa fa-pencil"></span> Typography</a></li>
          <li><a href="ui-portlet.html"><span class="fa fa-th"></span> Portlet</a></li>
          <li><a href="ui-sliders.html"><span class="fa fa-arrows-h"></span> Sliders</a></li>
          <li><a href="ui-alerts-popups.html"><span class="fa fa-warning"></span> Alerts & Popups</a></li>
          <li><a href="ui-lists.html"><span class="fa fa-list-ul"></span> Lists</a></li>
          <li><a href="ui-tour.html"><span class="fa fa-random"></span> Tour</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-pencil"></span> <span class="xn-text">Locations / Taxes</span></a>
        <ul>
          <li>
            <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
            <div class="informer informer-danger">New</div>
            <ul>
              <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
              <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
              <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
              <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
            </ul>
          </li>
          <li><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
          <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
          <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
          <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
          <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="tables.html"><span class="fa fa-table"></span> <span class="xn-text">Modules</span></a>
        <ul>
          <li><a href="table-basic.html"><span class="fa fa-align-justify"></span> Basic</a></li>
          <li><a href="table-datatables.html"><span class="fa fa-sort-alpha-desc"></span> Data Tables</a></li>
          <li><a href="table-export.html"><span class="fa fa-download"></span> Export Tables</a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Orders</span></a>
        <ul>
          <li><a href="charts-morris.html"><span class="xn-text">Morris</span></a></li>
          <li><a href="charts-nvd3.html"><span class="xn-text">NVD3</span></a></li>
          <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
          <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="maps.html"><span class="fa fa-map-marker"></span> <span class="xn-text">Reports</span></a>
        <ul>
          <li><a href="charts-morris.html"><span class="xn-text">Morris</span></a></li>
          <li><a href="charts-nvd3.html"><span class="xn-text">NVD3</span></a></li>
          <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
          <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
        </ul>
      </li>
      <li class="xn-openable">
        <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Tools</span></a>
        <ul>
          <li class="xn-openable">
            <a href="#">Second Level</a>
            <ul>
              <li class="xn-openable">
                <a href="#">Third Level</a>
                <ul>
                  <li class="xn-openable">
                    <a href="#">Fourth Level</a>
                    <ul>
                      <li><a href="#">Fifth Level</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
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
      <!-- MESSAGES -->
      <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-comments"></span></a>
        <div class="informer informer-danger">0</div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
            <div class="pull-right">
              <span class="label label-danger">0 new</span>
            </div>
          </div>
          <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">

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
        <div class="informer informer-warning">0</div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>
            <div class="pull-right">
              <span class="label label-warning">0 active</span>
            </div>
          </div>
          <div class="panel-body list-group scroll" style="height: 200px;">

          </div>
          <div class="panel-footer text-center">
            <a href="#">Show all tasks</a>
          </div>
        </div>
      </li>
      <!-- END TASKS -->
    </ul>
    <!-- END X-NAVIGATION VERTICAL -->
