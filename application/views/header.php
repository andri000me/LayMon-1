<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='dns-prefetch' href='<?=base_url()?>'>
<link href='https://fonts.gstatic.com' rel='preconnect'>
<link href='https://www.gstatic.com' rel='preconnect'>
<link href='https://fonts.googleapis.com' rel='preconnect'>
<link href='https://ajax.googleapis.com' rel='preconnect'>
<link href='https://fonts.googleapis.com' rel='preconnect'>
<link href='https://www.googletagmanager.com' rel='preconnect'>
<link rel="preconnect" href="https://code.ionicframework.com/">
<link rel="shortcut icon" href="<?=base_url('assets/favicon.ico')?>">
<meta name="robots" content="index, follow" />
<meta name="author" content="<?=$this->config->item('laymon_author')?>">
<meta name="description" content="<?=$this->config->item('laymon_deskripsi')?>"/>
<meta name="keywords" content="<?=$this->config->item('laymon_katakunci')?>" />
<link rel="alternate" href="<?=base_url()?>" hreflang="x-default"/>
<link rel="canonical" href="<?=base_url()?>" />

<title><?=$this->config->item('laymon_judul')?> | <?=$sub_title?></title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/fontawesome-free/css/all.min.css')?>">
<!-- IonIcons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker.css')?>">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')?>">
<!-- Tempusdominus Bbootstrap 4 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')?>">
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2/css/select2.min.css')?>">
<link rel="stylesheet" href="<?=base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?=base_url('assets/dist/css/adminlte.min.css')?>">
<!-- summernote -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/summernote/summernote-bs4.min.css')?>">
<!-- Sweetalert2 -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')?>">
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="<?=base_url('assets/dist/css/custom.css')?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-lightblue navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=base_url($home_url)?>" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?=base_url($home_url.'/profile')?>" class="nav-link">Profile</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('logout')?>"><i class="fas fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url($home_url)?>" class="brand-link">
      <center>
      <i class="nav-icon fas fa-box-open" title="<?=$this->config->item('laymon_judul')?>"></i> <span class="brand-text font-weight-light"><?=$this->config->item('laymon_judul')?></span>
      </center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url('assets/dist/img/user8-128x128.jpg')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="javascript:void(0)" class="d-block"><?=$this->session->userdata('username')?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=base_url($home_url)?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url($home_url.'/pelanggan')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url($home_url.'/supir')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url($home_url.'/mobil')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mobil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url($home_url.'/user')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="javascript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-tv"></i>
              <p>
                Pengiriman
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=base_url($home_url.'/monitoring/live')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Live Monitoring</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=base_url($home_url.'/monitoring')?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Completed</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?=base_url($home_url.'/laporan')?>" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Laporan
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>