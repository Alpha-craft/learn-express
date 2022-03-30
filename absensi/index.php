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
        <button type="button" class="btn btn-primary showBtn text-white">OK</button>
      </div>
    </div>
  </div>
</div>


<div class="m-4">
  <h3>Daftar Siswa</h1>
</div>
      
<div class="card mb-4">
  <div class="card-body">
    <!-- looping start here -->
    <?php for($i=0;$i<4;$i++): ?>
    <div class="row mb-3">
      <div class="col-auto">
        <img style="height: 50px; width:auto;" class="object-fit rounded-circle" src="https://images-ext-1.discordapp.net/external/e52z5nIbaakJ-6ahNta-YLkMuZHLONZFNUt4zA8h4JQ/%3Fsize%3D1024/https/cdn.discordapp.com/avatars/790416033471004702/9aa9b8a461d72950f4c9594714bf430c.webp" alt="">
      </div>
      <div class="col">
        <small class="d-block fw-bold">
          Ainur
        </small>
        <small class="d-block">
          Bianka ICHIBAN KAWAII
        </small>
      </div>
    </div>
    <?php endfor; ?>
    <!-- looping end here -->
  </div>       
</div>    

<div class="position-relative overflow-hidden">
  <div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <?php for($i=0; $i < 6; $i++): ?>
        <div class="swiper-slide">
          <div class="card">
            <div class="card-body">
              <div class="card-title text-center">
                <h4>Mapel:<?=$i?></h4>
                <h5>08:00-09:<?=$i?>0</h5>
              </div>
              <div class="row">
                <div class="col-12">
                  <a class="btn btn-primary w-100 m-auto mb-2" href="">Hadir</a>
                </div>
                <div class="col-12">
                  <a class="btn btn-secondary w-100 m-auto" href="">Izin</a>
                </div>
              </div>
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
  
<div class="m-4">
  <h3>History Absensi</h1>
</div>
      
<div class="card mb-4">
  <div class="card-body">
    <!-- looping start here -->
    <div class="row">
      <div class="col-3 col-md-6">Hari ini 08:50</div>
      <div class="col-9 col-md-6">User1 menyatakan Hadir</div>
    </div>
    <div class="row">
      <div class="col-3 col-md-6">Hari ini 08:50</div>
      <div class="col-9 col-md-6">User1 menyatakan Hadir</div>
    </div>
    <div class="row">
      <div class="col-3 col-md-6">Hari ini 08:50</div>
      <div class="col-9 col-md-6">User1 menyatakan Hadir</div>
    </div>
    <!-- looping end here -->
    <button type="button" class="showBtn text-white btn btn-primary col-12 col-md-3 btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Lihat absensi
    </button> 
  </div>       
</div>    




<script type="module">
  var swiper = new Swiper('.swiper', {
    loop: true,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    slidesPerView: 3,
    spaceBetween: 30,
  });
</script>

<?php include '../components/footer.php'; ?>  