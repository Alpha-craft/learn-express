<?php 
  require __DIR__.'/../dist/database.php';

  if(isset($_POST['submit'])){
    $timenow = date("H:i:s");

    $title = $_POST['title'];
    $cat = $_POST['category'] ?? '';
    $body = $_POST['body'] ?? '';
    $attachment =$_POST['attId'] ?? '';
    $author = $_SESSION['id'];
    $sub_start = strlen($_POST['strDate']) != 0 ? "'".$_POST['strDate'].' '.$timenow."'" : 'null';
    $sub_end = strlen($_POST['endDate']) != 0 ? "'".$_POST['endDate'].' '.$timenow."'" : 'null';

    mysqli_query($conn, "INSERT INTO task(id, title, category, body, attachments, author, date_created, submission_start, submission_end)
      VALUES(null, '$title', '$cat', '$body', '$attachment', $author, '$now', $sub_start, $sub_end)
    ");
  }

  $pageTitle = 'Tugas baru';
  include '../components/header.php';  
?>
      

<div class="text-center mb-4">
  <h3>Buat Tugas Baru</h3>
</div>

<?php if(!in_array('pengajar', $currUserRoles)): ?>
  <?php 
    $alertRole = 'Pengajar';
    include __DIR__.'/../components/card_alert.php'; 
  ?>
<?php else: ?>
  <?php include __DIR__.'/../components/modal_upload.php'; ?>
  
  <div class="card">
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label">Nama Tugas</label>
          <input type="text" class="form-control" name="title" placeholder="Masukkan nama tugas" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Category</label>
          <input type="text" class="form-control" name="category" placeholder="Masukkan category tugas">
        </div>
        <div class="mb-3">
          <label class="form-label">Deskripsi Tugas</label>
          <textarea class="form-control" name="body" rows="10" placeholder="Masukkan deskripsi penjelasan tugas"></textarea>
        </div>      

        <div class="row mb-3">
          <div class="col-12 col-md-6 mb-3">
            <label class="form-label">Pembukaan Submission</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="las la-calendar"></i>
              </span>
              <input type="text" class="form-control" id="strDate" name="strDate" placeholder="YYYY-MM-DD">
            </div> 
          </div>   

          <div class="col-12 col-md-6 mb-3">
            <label class="form-label">Deadline Submission</label>
            <div class="input-group">
              <span class="input-group-text">
                <i class="las la-calendar"></i>
              </span>
              <input type="text" class="form-control" id="endDate" name="endDate" placeholder="YYYY-MM-DD">
            </div>          
          </div> 
        </div>                 

        <div class="mb-3">
          <div class="form-label">File Attachment</div>
          <div class="d-flex mb-2">
            <div class="me-3">
              <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpload">
                Pilih file
              </button>
            </div>
            <div id="fileLength">

            </div>
          </div>        
          <div id="selectedFiles">

          </div>
        </div>

        <input type="hidden" name="attId" id="attachment">

        <div class="mt-4">
          <button type="submit" name="submit" class="mt-5 btn btn-primary">
            Buat Tugas
          </button>
        </div>      
      </form>
    </div>
  </div>


  <script type="text/javascript">
    let strDate = new Pikaday({ 
      field: document.getElementById('strDate'),
      format: 'YYYY-MM-DD'
    });
    let endDate = new Pikaday({ 
      field: document.getElementById('endDate'),
      format: 'YYYY-MM-DD'
    });      
  </script>
<?php endif; ?>


<?php include '../components/footer.php'; ?>  