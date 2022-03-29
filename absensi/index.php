<?php 
  require __DIR__.'/../dist/database.php';
  
  $pageTitle = 'Absensi';
  include __DIR__.'/../components/header.php'; 
?>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Absensi Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body" id="rincian_data_keuangan">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Waktu</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>User1</td>
              <td>Hadir</td>
              <td>Baru saja</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>User2</td>
              <td>Hadir</td>
              <td>5 Menit yang lalu</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>User3</td>
              <td>Izin Sakit Panas</td>
              <td>15 Menit yang lalu</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn showBtn text-white">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="text-center mb-4">
  <h3>Keuangan Masjid</h1>
</div>
      
<div class="card mb-4">
  <div class="card-body">
    <div class="d-flex justify-content-between">
      <div>
        <div>Hari ini 08:35</div>
        <div>Hari ini 08:40</div>
        <div>Hari ini 08:55</div>
      </div>
      <div>
        <div>User1 menyatakan hadir</div>
        <div>User2 menyatakan hadir</div>
        <div>User3 menyatakan izin sakit panas</div>
      </div>
    </div>
    <button type="button" class="showBtn text-white btn btn-sm m-3 mt-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Lihat absensi
    </button> 
  </div>       
</div>    


<div class="position-relative overflow-hidden">
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <?php for($i=0; $i < 5; $i++): ?>
        <div class="swiper-slide">
          <div class="card">
            <div class="card-body">
              
            </div>
          </div>          
        </div>
      <?php endfor; ?>
    </div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
</div>
  


<script type="module">
  var swiper = new Swiper('.swiper', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>

<?php include '../components/footer.php'; ?>  