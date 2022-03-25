<?php
  require __DIR__.'/../../dist/database.php';

  $pageTitle = 'Keuangan';
  include __DIR__.'/../../components/header.php';
?>


<div class="text-center mb-4">
  <h3>Keuangan Masjid</h1>
</div>

<div class="row px-0"> 
  <div class="col-12 col-md-8" x-data="cashManager()">

  </div>

  <div class="col-12 col-md-4">
    <?php include __DIR__.'/../../components/card_keuangan.php'; ?>  
  </div>
</div>

<?php
  include __DIR__.'/../../components/footer.php';
?>