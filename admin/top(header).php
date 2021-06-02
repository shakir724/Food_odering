<?php
ob_start();//to solve warring header can not modify
session_start();
include('../database.inc.php');// ../ is use to call this from one folder back


if(!isset($_SESSION['LOGIN']))
{
    header('location:login.php');
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Ordering Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/css/font.css"> <!-- font aowse icon cdn-->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="sidebar-light">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
        <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
          <li class="nav-item nav-toggler-item">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
          
        </ul>
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo.png" alt="logo"/></a>
        </div>
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
              <i class="fa fa-user m-0 "></i>
              <span class="nav-profile-name m-0 p-0"><?php echo $_SESSION['Admin_name'] ?></span>
              <i class="fa fa-angle-down p-2px"></i>
            </a>
            <div  class="dropdown-menu dropdown-menu-right navbar-dropdown" >
              <div class="dropdown-divider"></div><!--this code will solve the error of dropdwon-->
              <!--style done by me-->
              <a class="dropdown-item" href="logout.php">
                <i  class="fa fa-sign-out" ></i>
                Logout
              </a>
            </div>
          </li>        
          <li class="nav-item nav-toggler-item-right d-lg-none">
            <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
              <span class="mdi mdi-menu"></span>
            </button>
          </li>
        </ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
            <i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp &nbsp &nbsp
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="category.php">
            <i class="mid fa fa-dot-circle-o" aria-hidden="true"></i> &nbsp &nbsp &nbsp
              <span class="menu-title">Category</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="user.php">
              <i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp &nbsp &nbsp
              <span class="menu-title">User</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="delivery_boy.php">
              <i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp &nbsp &nbsp
              <span class="menu-title">Delivery Boy</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dish.php">
              <i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp &nbsp &nbsp
              <span class="menu-title">Dish</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">
              <i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp &nbsp &nbsp
              <span class="menu-title">Contact Us</span>
            </a>
          </li>
		  
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">