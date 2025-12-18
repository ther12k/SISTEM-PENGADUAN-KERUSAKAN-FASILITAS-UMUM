<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Admin | Sistem Pengaduan</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="codedthemes" />
    <!-- [Favicon] icon -->
    <link rel="icon" href="<?=base_url()?>assets/images/favicon.svg" type="image/x-icon" />
 <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" id="main-font-link" />
<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="<?=base_url()?>assets/fonts/phosphor/duotone/style.css" />
<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="<?=base_url()?>assets/fonts/tabler-icons.min.css" />
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="<?=base_url()?>assets/fonts/feather.css" />
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="<?=base_url()?>assets/fonts/fontawesome.css" />
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="<?=base_url()?>assets/fonts/material.css" />
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css" id="main-style-link" />
<link rel="stylesheet" href="<?=base_url()?>assets/css/style-preset.css" />
<!-- Notiflix -->
<link rel="stylesheet" href="<?=base_url('assets')?>/notiflix/notiflix-3.2.8.min.css" />
<script src="<?=base_url('assets/notiflix/notiflix-3.2.8.min.js')?>"></script>
 <!-- Jquery -->
    <script src="<?=base_url('assets/js/plugins/jquery-3.7.1.min.js')?>"></script>
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="<?=base_url('admin/dashboard')?>" class="b-brand text-primary">
        <!-- ========   Change your logo from here   ============ -->
        <img src="<?=base_url()?>assets/images/logo-app.png" alt="" class="img-fluid" />
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
         <li class="pc-item pc-caption">
          <label>Main Menu</label>
          <i class="ti ti-apps"></i>
        </li>
        <li class="pc-item">
          <a href="<?=base_url('admin/dashboard')?>" class="pc-link"
            ><span class="pc-micon"><i class="ti ti-dashboard"></i></span><span
            class="pc-mtext">Dashboard</span></a
          >
        </li>

        <li class="pc-item">
          <a href="<?=base_url('admin/komplaint')?>" class="pc-link">
            <span class="pc-micon"><i class="ti ti-list"></i></span>
            <span class="pc-mtext">Data Komplaint</span>
          </a>
        </li>

  
        <li class="pc-item pc-caption">
          <label>Admin</label>
          <i class="ti ti-news"></i>
        </li>
        <li class="pc-item">
          <a class="pc-link" href="<?=base_url('admin/profil')?>">
            <span class="pc-micon"><i class="ti ti-user"></i></span>
            <span class="pc-mtext">Profil Admin</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="<?=base_url('admin/logout')?>" class="pc-link">
            <span class="pc-micon"><i class="ti ti-logout"></i></span>
            <span class="pc-mtext">Logout</span>
          </a>
        </li>

      </ul>

    </div>
  </div>
</nav>
<!-- [ Sidebar Menu ] end -->
 <!-- [ Header Topbar ] start -->
<header class="pc-header">
  <div class="header-wrapper"><!-- [Mobile Media Block] start -->
<div class="me-auto pc-mob-drp">
  <ul class="list-unstyled">
    <li class="pc-h-item header-mobile-collapse">
      <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="pc-h-item pc-sidebar-popup">
      <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
        <i class="ti ti-menu-2"></i>
      </a>
    </li>
    <li class="dropdown pc-h-item d-inline-flex d-md-none">
      <a
        class="pc-head-link head-link-secondary dropdown-toggle arrow-none m-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i class="ti ti-search"></i>
      </a>
      <div class="dropdown-menu pc-h-dropdown drp-search">
        <form class="px-3">
          <div class="mb-0 d-flex align-items-center">
            <i data-feather="search"></i>
            <input type="search" class="form-control border-0 shadow-none" placeholder="Search here. . ." />
          </div>
        </form>
      </div>
    </li>
    <li class="pc-h-item d-none d-md-inline-flex">
      <form class="header-search">
        <i data-feather="search" class="icon-search"></i>
        <input type="search" class="form-control" placeholder="Search here. . ." />
        <button class="btn btn-light-secondary btn-search"><i class="ti ti-adjustments-horizontal"></i></button>
      </form>
    </li>
  </ul>
</div>
<!-- [Mobile Media Block end] -->
<div class="ms-auto">
  <ul class="list-unstyled">
    <li class="dropdown pc-h-item">
      <a
        class="pc-head-link head-link-secondary dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <i class="ti ti-bell"></i>
      </a>
      <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header">
          <a href="#!" class="link-primary float-end text-decoration-underline">Mark as all read</a>
          <h5>
            All Notification
            <span class="badge bg-warning rounded-pill ms-1">01</span>
          </h5>
        </div>
        <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
          <div class="list-group list-group-flush w-100">
            <div class="list-group-item list-group-item-action">
              <div class="d-flex">
                <div class="flex-shrink-0">
                  <div class="user-avtar bg-light-success"><i class="ti ti-building-store"></i></div>
                </div>
                <div class="flex-grow-1 ms-1">
                  <span class="float-end text-muted">3 min ago</span>
                  <h5>New Complaint</h5>
                  <p class="text-body fs-6">There is a new complaint to respond.</p>
                  <div class="badge rounded-pill bg-light-danger">Unread</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="text-center py-2">
          <a href="#!" class="link-primary">Mark as all read</a>
        </div>
      </div>
    </li>
    <li class="dropdown pc-h-item header-user-profile">
      <a
        class="pc-head-link head-link-primary dropdown-toggle arrow-none me-0"
        data-bs-toggle="dropdown"
        href="#"
        role="button"
        aria-haspopup="false"
        aria-expanded="false"
      >
        <img src="<?=base_url()?>assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar" />
        <span>
          <i class="ti ti-settings"></i>
        </span>
      </a>
      <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
        <div class="dropdown-header">
          <h4>
            Good Morning,
            <span class="small text-muted"><?=session()->get('username')?></span>
          </h4>
          <p class="text-muted">Administrator</p>
          <hr />
          <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
            <a href="<?=base_url('admin/profil')?>" class="dropdown-item">
              <i class="ti ti-settings"></i>
              <span>Account Settings</span>
            </a>
            <a href="<?=base_url('admin/logout')?>" class="dropdown-item">
              <i class="ti ti-logout"></i>
              <span>Logout</span>
            </a>
          </div>
        </div>
      </div>
    </li>
  </ul>
</div>
</div>
</header>
<!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    <div class="pc-container">
      <div class="pc-content">
        <?=$this->renderSection('content');?>

        <!-- [ Main Content ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
      <div class="footer-wrapper container-fluid">
        <div class="row">
          <div class="col-sm-6 my-1">
            <p class="m-0">
              Sistem Pengaduan &#9829; crafted by Team
            </p>
          </div>
          <div class="col-sm-6 ms-auto my-1">
            <ul class="list-inline footer-link mb-0 justify-content-sm-end d-flex">
              <li class="list-inline-item"><a href="<?=base_url('admin/dashboard')?>">Dashboard</a></li>
              <li class="list-inline-item"><a href="<?=base_url('admin/komplaint')?>">Komplaint</a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
 <!-- Required Js -->
<script src="<?=base_url()?>assets/js/plugins/popper.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/simplebar.min.js"></script>
<script src="<?=base_url()?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/js/icon/custom-font.js"></script>
<script src="<?=base_url()?>assets/js/script.js"></script>
<script src="<?=base_url()?>assets/js/theme.js"></script>
<script src="<?=base_url()?>assets/js/plugins/feather.min.js"></script>


  </body>
  <!-- [Body] end -->
</html>