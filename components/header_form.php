<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/bootstrap.css" type="text/css"> 
  <script src="/assets/js/bootstrap.js"></script>  
  <script defer src="/assets/js/alpine.js"></script>
  <title><?= $pageTitle ?? 'Home' ?> | E-Muhajirin</title>
</head>
<body>
  <div class="position-relative min-vh-100 py-3">
    <img src="assets/image/form-background.jpg" alt="bg" class="w-100 h-100">
    <div class="position-absolute top-0 left-0 d-flex justify-content-center align-items-center w-100 h-100 p-3" style="z-index: 20; background: rgba(55, 55, 55, 0.1)">
      <div class="row px-0 mx-auto shadow rounded-3 overflow-hidden w-100" style="max-width: 800px;">
        <div class="col-12 col-lg-6 d-flex align-items-center text-center bg-primary rounded-s overflow-hidden">
          <div class="p-3 p-md-4">
            <h1 class="display-6 text-light mb-0">Website Masjid Muhajirin</h1>
            <h4 class="text-light fw-light fst-italic">Sunnah Never Dies</h4>
          </div>        
        </div>
        <div class="col-12 col-lg-6 bg-white p-3 p-md-4 rounded-e overflow-hidden">
          <form method="post">
