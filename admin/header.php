<?php session_start(); ?>

<?php
  if(!isset($_SESSION['admin'])) {
    echo "<script>location ='login.php';</script>";
    header('location: login.php');
    exit();
  }
?>

<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bekhan TV</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bower_components/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>B</b>TV</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Bekhan</b>TV</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="assets/dist/img/bekhan.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Bekhan Supriyanto</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="assets/dist/img/bekhan.jpg" class="img-circle" alt="User Image">

                <p>
                  Bekhan Supriyanto
                  <small>Owner at BekhanTV</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <!-- <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div> -->
                <div class="text-center ">
                  <a href="index.php?halaman=logout" class="btn btn-default btn-flat btn-block">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/dist/img/bekhan.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Bekhan Supriyanto</p>
          <!-- Status -->
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="index.php?halaman=home"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>
        <li><a href="index.php?halaman=produk"><i class="fa fa-cube"></i> <span>Produk</span></a></li>
        <li><a href="index.php?halaman=pelanggan"><i class="fa fa-user"></i> <span>Pelanggan</span></a></li>
        <li><a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart"></i> <span>Pembelian</span></a></li>
        <li><a href="index.php?halaman=laporan_pembelian"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
        <li><a href="index.php?halaman=logout"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>