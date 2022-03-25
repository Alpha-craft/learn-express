<?php 
  require __DIR__.'/../dist/database.php';

  if(isset($_POST['confirm'])){
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

  <!-- Modal -->
  <div class="modal fade" id="modalUpload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalUpload" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <form method="POST" enctype="multipart/form-data" x-data="fileUploader()">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalUpload">Pilih File Attachment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-4">
              <label for="uploadFiles" class="form-label">Upload Attachment</label>
              <input name="files[]" type="file" x-on:input="uploadFile()" id="uploadFiles" class="form-control form-control-sm" multiple>
            </div>                      

            <hr>
            
            <div class="my-4">
              <h5>File yang anda upload:</h5>
              <div class="d-flex flex-column" id="listFile">

              </div>          
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" x-on:click="submitFiles()" data-bs-dismiss="modal">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>

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
          <div class="row">
            <div class="col">
              <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpload">
              Pilih file
              </button>
            </div>
            <div class="col-auto" id="fileLength">

            </div>
          </div>        
          <div id="selectedFiles">

          </div>
        </div>

        <input type="hidden" name="attId" id="attachment">

        <div class="mt-4">
          <button type="submit" name="confirm" class="mt-5 btn btn-primary">
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

    function fileUploader(){
      return {
        uploadFile() {
          let notyf = new Notyf();
          let files = document.getElementById("uploadFiles").files;

          if (files.length > 0){
            let data = new FormData();
            let request = new XMLHttpRequest();

            for(var i = 0; i < files.length; ++i){
              data.append('files[]', files[i]);
            }

            request.open("POST", "/ajax/upload_file.php", true);
            request.setRequestHeader('Cache-Control','no-cache');

            request.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {              
                notyf.success('File anda berhasil ter-upload!');              
              }
            };
            
            request.send(data);          
          } else{
            notyf.error("Tolong pilih file untuk diupload");
          }

          this.getFiles();
        },
        submitFiles(){
          let checkboxs = document.getElementsByClassName('checkbox-file');
          let fileNames = document.getElementsByClassName('checkbox-label');
          let attIds = '';
          let selectedFiles = '';

          for(let i = 0; i < checkboxs.length; i++){
            if(checkboxs[i].checked){
              attIds += checkboxs[i].value + ',';
              selectedFiles += `<div class="mb-2">${ fileNames[i].innerHTML }</div>`
            }          
          }

          if(attIds != ''){
            let ids = attIds.slice(0, -1);

            document.getElementById('attachment').value = ids;
            document.getElementById('selectedFiles').innerHTML = selectedFiles;
            document.getElementById('fileLength').innerHTML = ids.split(',').length + ' File'
          }        
        },
        getFiles(){
          let xmlhttp = null;

          if (window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
          }
          else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }

          xmlhttp.onreadystatechange = function(){
            if (xmlhttp.readyState == 4){
              document.getElementById("listFile").innerHTML = xmlhttp.responseText;
            }          
          }

          xmlhttp.open("GET", "/ajax/list_file.php", true);
          xmlhttp.send();
        },
        getDatepicker(){
          const getDatePickerTitle = elem => {
            const label = elem.nextElementSibling;
            let titleText = '';
            if (label && label.tagName === 'LABEL') {
              titleText = label.textContent;
            } else {
              titleText = elem.getAttribute('aria-label') || '';
            }
            return titleText;
          }

          const elems = document.getElementById('datepicker');
          for (const elem of elems) {
            const datepicker = new Datepicker(elem, {
              format: 'dd-mm-yyyy',
              title: ''
            });
          }     
        }
      }
    }  

    window.onload = fileUploader().getFiles();
  </script>
<?php endif; ?>


<?php include '../components/footer.php'; ?>  