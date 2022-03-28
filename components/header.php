<?php 
  require __DIR__.'/../dist/data.php'; 

  if(!isset($_SESSION['email'])){
    header("location: /masuk.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css"> 
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
  <link rel="stylesheet" href="/assets/css/main.css" type="text/css">
  <link rel="icon" type="image/x-icon" href="/assets/image/favicon.png">
  <script src="/assets/js/bootstrap.js"></script>  
  <script src="https://unpkg.com/htmx.org@1.7.0" integrity="sha384-EzBXYPt0/T6gxNp0nuPtLkmRpmDBbjg6WmCUZRLXBBwYYmwAUxzlSGej0ARHX0Bo" crossorigin="anonymous"></script>    
  <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
  <script defer src="/assets/js/alpine.js"></script>
  <title><?= $pageTitle ?? 'Home' ?> | E-Muhajirin</title>
</head>
<body>
  <div class="expand" id="wrapper">  
    <header class="navbar navbar-dark bg-exam border-thick shadow-sm position-fixed w-100 d-md-none" style="z-index: 150;">
      <div class="container-fluid">
        <button class="navbar-toggler border border-white" style="z-index: 200;" type="button" onclick="sidebarToggle()">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/" class="text-decoration-none mb-0 text-light mobile-logo">
          <img src="<?= '/assets/image/logo.png' ?>" alt="logo" height="60">
        </a>
      </div>
    </header>

    <aside class="sidebar d-flex flex-column">
      <div class="position-relative d-flex bg-exam border-thick overflow-hidden">
        <a href="/" class="text-decoration-none mb-0 text-light p-2 desktop-logo">
          <img src="<?= '/assets/image/logo.png' ?>" alt="logo" height="60">
        </a>
        <div class="position-absolute d-flex align-items-center end-0 px-3 h-100" style="z-index: 10; background-color: rgb(71, 197, 255);">
          <button class="btn btn-outline-light d-block ms-auto py-0 px-1" onclick="sidebarToggle()" id="sidebarAngleBtn">
            <i class="las la-angle-left h4 mb-0 d-block py-1 h-100 align-middle"></i>
          </button>
        </div>        
      </div>
      <div class="sidenav sidenav-body pt-3 pb-5" style="overflow-y: scroll;">
        <?php foreach($sidebar as $sub): ?>
          <a class="d-flex no-hover mt-3">
            <div class="icon"></div>
            <div class="label fs-5 fw-bold d-flex align-items-center">
              <?= $sub['label'] ?>
            </div>            
          </a>
          <?php foreach($sub['item'] as $item): ?>
            <?php if(!empty($item)): ?>
              <a href="<?= $item['url'] ?>" class="d-flex px-3 py-1">
                <div class="icon">
                  <i class="las la-<?= $item['icon'] ?>"></i>
                </div>
                <div class="label d-flex align-items-center">
                  <?= $item['label'] ?>
                </div>
              </a>
            <?php else: ?>
              <div class="w-100 bg-light my-2" style="height: 1px;"></div>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endforeach; ?>
      </div>
      <div class="position-relative mt-auto border-top border-light" x-data="{ open: false }"> 
        <div class="sidenav d-flex align-items-center cursor-pointer text-light px-3" style="height: 76px;" x-on:click="open = true">
          <div class="icon">
            <i class="las la-user-circle"></i>
          </div>
          <div class="d-flex flex-column text-start">
            <small><?= $currUser['email'] ?></small>
            <div><?= $currUser['name'] ?></div>           
          </div>               
          <div class="ms-auto">
            <i class="las la-caret-down" x-show="open"></i>
            <i class="las la-caret-up" x-show="!open"></i>
          </div>
        </div>

        <div class="position-absolute right-0 bottom-0" style="margin-bottom: 76px;">
          <div class="rounded-b-0 card w-100 py-2 mx-3" x-show="open" x-on:click.outside="open = false">
            <a class="dropdown-item" href="/profil.php">Profil Pengguna</a>
            <a class="dropdown-item hover-link-danger" href="/keluar.php">Keluar</a>            
          </div>
        </div>        
      </div>
    </aside>      
  
    <div class="main py-5 px-2 p-md-3 mb-5">
      <div class="py-4 mb-5">