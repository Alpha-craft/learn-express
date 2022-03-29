<?php
  require __DIR__.'/../../dist/database.php';


  if(isset($_POST['submit'])){
    $cashDate = $_POST['datetime'] ?? null;
    $in = $_POST['cashIn'] ?? 0;
    $out = $_POST['cashOut'] ?? 0;
    $inDesc =$_POST['inDesc'] ?? '';
    $outDesc = $_POST['outDesc'] ?? '';
    $author = $_SESSION['id'];
    $newCash = ($main['cash'] + $in) - $out;

    if($cashDate != ''){
      mysqli_query($conn, "INSERT INTO cash(id, cash_date, cash_in, cash_out, in_description, out_description, author, date_created)
        VALUES(null, '$cashDate', $in, $out, '$inDesc', '$outDesc', $author, '$now')
      ");

      mysqli_query($conn, "UPDATE main SET cash = $newCash WHERE id = 1");
    }
  }

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
      <form method="POST"> 
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modal" aria-hidden="true">      
          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Rincian Data Keuangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">                           
                <input type="hidden" name="datetime" x-model="modalDatetime">
                <input type="hidden" name="cashIn" x-model="modalIn">
                <input type="hidden" name="cashOut" x-model="modalOut">
                <input type="hidden" name="inDesc" x-model="modalInDesc">
                <input type="hidden" name="outDesc" x-model="modalOutDesc">

                <div>
                  Hari/Tanggal: <span x-text="modalDatetime"></span>
                </div>  

                <div>
                  Saldo saat ini <span x-text="formater.format(modalCurrCash)"></span>
                </div>            

                <div x-show="modalIn != ''">
                  Pemasukan: <span x-text="formater.format(modalIn)"></span>
                </div>  
                <div x-show="modalOut != ''">
                  Pengeluaran: <span x-text="formater.format(modalOut)"></span>
                </div>  

                <div x-show="modalInDesc != ''">
                  Rincian Pemasukan: <span x-text="modalInDesc"></span>
                </div>  
                <div x-show="modalOutDesc != ''">
                  Rincian Pengeluaran: <span x-text="modalOutDesc"></span>
                </div>  

                <div>
                  Total: <span x-text="modalTotal"></span>
                </div>

              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" name="submit" class="btn btn-primary text-white">Konfirmasi</button>
              </div>
            </div>
          </div>
        </div>
      </form>

      <!-- Form -->
      <div class="card">
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
                <input type="text" class="form-control" id="cashIn" x-on:input="formatCash($el)" placeholder="00000">
              </div>            
            </div>

            <div class="mb-3 col-12 col-md-6">
              <label class="form-label">Pengeluaran</label>
              <div class="input-group">
                <span class="input-group-text text-white bg-primary">Rp</span>
                <input type="text" class="form-control" id="cashOut" x-on:input="formatCash($el)" placeholder="00000">
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

          <button type="button" class="btn btn-primary d-block w-100 mt-5" x-on:click="getModal()">
            Submit
          </button>
        </div>                
      </div>
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
        formater: new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'}),
        modalCurrCash: 0,
        modalDatetime: '',
        modalIn: 0,
        modalOut: 0,
        modalInDesc: '',
        modalOutDesc: '',
        modalTotal: '',
        formatCash(elem){  
          let val = elem.value.replaceAll(/\D/gm, '');
          let formater = new Intl.NumberFormat('id-ID', {});

          elem.value = formater.format(val);
        },
        getModal(){
          if(document.getElementById('date').value != ''){
            let saldo = <?= $main['cash'] ?? 'null' ?>;
            let cin = document.getElementById('cashIn').value == '' ? 0 : document.getElementById('cashIn').value.replaceAll('.', '');
            let cout = document.getElementById('cashOut').value == '' ? 0 : document.getElementById('cashOut').value.replaceAll('.', '');       

            this.modalCurrCash = saldo;
            this.modalDatetime = document.getElementById('date').value;
            this.modalIn = cin;
            this.modalOut = cout;
            this.modalInDesc = document.getElementById('inDesc').value;
            this.modalOutDesc = document.getElementById('outDesc').value;

            this.modalTotal = this.formater.format((saldo + parseInt(cin)) - parseInt(cout));
          } else{
            let modal = bootstrap.Modal.getInstance(document.getElementById('modal'))
            modal.show();

            let notyf = new Notyf();
            notyf.error('Mohon sertakan tanggal');

          }   
        }
      }
    }
  </script>
<?php endif; ?>

<?php
  include __DIR__.'/../../components/footer.php';
?>