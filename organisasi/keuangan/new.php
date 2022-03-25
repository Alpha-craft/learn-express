<?php
  require __DIR__.'/../../dist/database.php';

  $pageTitle = 'Keuangan';
  include __DIR__.'/../../components/header.php';
?>


<div class="text-center mb-4">
  <h3>Keuangan Masjid</h1>
</div>

<?php if(!in_array('bendahara', $currUserRoles)): ?>
  <?php 
    $alertRole = 'Bendahara';
    include __DIR__.'/../../components/card_alert.php'; 
  ?>
<?php else: ?>
  <div class="row px-0"> 
    <div class="col-12 col-md-8" x-data="cashManager()">
      <!-- Modal -->
      <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLabel">Rincian Data Keuangan</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div></div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary text-white">Simpan</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Form -->
      <form method="POST" class="card">
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="text" class="form-control" id="date" style="max-width: 200px;" placeholder="YYYY-MM-DD">
          </div>

          <div class="row">          
            <div class="mb-3 col-12 col-md-6">
              <label class="form-label">Pemasukan</label>
              <div class="input-group">
                <span class="input-group-text text-white bg-primary">Rp</span>
                <input type="text" class="form-control" id="cashIn" placeholder="00000">
              </div>            
            </div>

            <div class="mb-3 col-12 col-md-6">
              <label class="form-label">Pengeluaran</label>
              <div class="input-group">
                <span class="input-group-text text-white bg-primary">Rp</span>
                <input type="text" class="form-control" id="cashOut" placeholder="00000">
              </div>            
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Rincian Pemasukan</label>
            <textarea class="form-control" id="inDesc" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Rincian Pengeluaran</label>
            <textarea class="form-control" id="outDesc" rows="3"></textarea>
          </div>

          <button type="button" class="btn btn-primary d-block w-100 mt-5" data-bs-toggle="modal" data-bs-target="#modal">
            Submit
          </button>
        </div>                
      </form>
    </div>

    <div class="col-12 col-md-4">
      <?php include __DIR__.'/../../components/card_keuangan.php'; ?>      
    </div>
  </div>

  <script>
    let cashDate = new Pikaday({ 
      field: document.getElementById('date'),
      format: 'YYYY-MM-DD'
    });

    function cashManager(){
      return {
        
      }
    }
  </script>
<?php endif; ?>

<?php
  include __DIR__.'/../../components/footer.php';
?>