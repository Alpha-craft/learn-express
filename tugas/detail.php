<?php 
  require __DIR__.'/../dist/database.php'; 
  $taskId = $_GET['q'] ?? null;

  if($taskId == null){
    header("location: /tugas");
  }

  $task = $taskId;
  $author = $_SESSION['id'];
  $note = $_POST['note'] ?? '';
  $attachment = $_POST['attId'] ?? '';

  if(isset($_POST['submit'])){    
    mysqli_query($conn, "INSERT INTO submission(id, task, author, note, attachments, date_created)
      VALUES(null, $task, $author, '$note', '$attachment', '$now')
    ");

  } elseif(isset($_POST['edit'])){
    mysqli_query($conn, "UPDATE submission 
      SET note = '$note',
          attachments = '$attachment'
      WHERE task = $taskId
    ");

  }

  $getTask = mysqli_query($conn, "SELECT * FROM task WHERE id = $taskId");
  $task = mysqli_fetch_assoc($getTask);

  $getSubmis = mysqli_query($conn, "SELECT * FROM submission WHERE task = $taskId AND author = $author");
  $submis = mysqli_fetch_assoc($getSubmis);

  $pageTitle = $task['title'];

  include '../components/header.php';   
?>



<div class="text-center mb-4">
  <h3>Detail Tugas</h3>
</div>


<?php include __DIR__.'/../components/modal_upload.php'; ?>

<div class="row">
  <div class="col-12 col-md-9">
    <div class="card mb-4">
      <div class="card-body p-2">
        <div class="d-flex align-items-start">
          <div class="w-100">
            <h4><?= $task['title'] ?></h4>
            <small class="text-muted d-block">Pengajar: <?= get_user($conn, 'id', $task['author'])['name'] ?></small>
            <small class="text-muted d-block">
              Dibuat pada <?= Date('d M Y', strtotime($task['date_created'])) ?>
            </small>
          </div>          
          <div class="ms-auto">
            <div class="badge bg-primary shadow-sm">
              <?= $task['category'] ?>
            </div>
          </div>              
        </div>    
        
      </div>
    </div>

    <div class="card mb-4">
      <div class="card-body">        

        <div class="d-flex flex-wrap align-content-center mb-4">
          <?php if($task['submission_start'] != ''): ?>
            <div class="me-3">
              <div class="text-muted">Dibuka pada:</div>
              <div class="fw-bold p-1 px-2 bg-info text-nowrap rounded text-light">
                <?= get_formatted_date($task['submission_start'], '') ?>
              </div>
            </div>                  
          <?php endif; ?>
          <?php if($task['submission_end'] != ''): ?>
            <div class="me-3">
              <div class="text-muted">Ditutup pada:</div>
              <div class="fw-bold p-1 px-2 bg-danger text-nowrap rounded text-light">
                <?= get_formatted_date($task['submission_end'], '') ?>
              </div>
            </div>                  
          <?php endif; ?>
        </div>
        
        <div class="row pb-5">
          <?php if($task['body'] != null): ?>
            <div class="col-12 col-md-7 col-lg-8 mb-4">
              <?= nl2br($task['body']) ?>
            </div>
          <?php endif; ?>

          <?php if($task['attachments'] != null): ?>
            <div class="col-12 col-md-5 col-lg-4">             
              <?php
                $att = $task['attachments'];
                include __DIR__.'/../components/card_attachment.php';
              ?>              
            </div>
          <?php endif; ?>
        </div>                                 
      </div>
    </div>    

    <div x-data="{ open: <?= empty($submis) ? 'true' : 'false' ?> }">          
      <?php if(!empty($submis)): ?>
        <div class="card w-100 mb-4" style="max-width: 700px; border-left: 4px solid limegreen;">
          <div class="card-body">
            <h5>Submission tugas telah dikumpulkan</h5>
            <div class="mb-3">
              Kamu sudah membuat submission untuk tugas ini, klik tombol berikut untuk mengedit submission
            </div>
            <button class="btn btn-primary btn-sm" x-on:click="open = !open">
              Edit Tugas
            </button>    
          </div>    
        </div>
      <?php endif; ?>

      <form method="POST" class="card rounded overflow-hidden mb-4" x-show="open">
        <div class="card-header">
          <?= empty($submis) ? 'Buat' : 'Edit' ?> Submission
        </div>
        <div class="card-body">             
          <input type="hidden" name="attId" id="attachment">                      

          <div class="mb-3">
            <h5>Teks untuk Submission</h5>
            <textarea placeholder="Tulis jawaban atau keterangan dari attachment yang kamu kirimkan.."
              class="form-control" name="note" rows="10"><?= !empty($submis) ? $submis['note'] : '' ?></textarea>
          </div>      

          <div class="mb-3">
            <h5>Attachment untuk Submission</h5>
            <div class="d-flex">                     
              <div class="me-3" id="selectedFiles">                    
                <?php
                  if(!empty($submis)){
                    $att = $submis['attachments'];
                    include __DIR__.'/../components/card_attachment.php';

                  } else{
                    echo '
                      <small class="text-muted">
                        *tidak ada attachment yang dipilih
                      </small> 
                    ';

                  }
                ?>                                                            
              </div>
              <div id="fileLength"></div>  
            </div>                         
          </div> 
                      
        </div>          
        <div class="card-footer d-flex justify-content-end">            
          <button type="button" class="btn btn-outline-dark me-3" data-bs-toggle="modal" data-bs-target="#modalUpload">
            <i class="las la-plus"></i> Attachment
          </button>
          <button type="submit" name="<?= empty($submis) ? 'submit' : 'edit' ?>" class="btn btn-primary">
            Kumpulkan
          </button>
        </div>
      </form>
    </div>


  </div>
  <div class="col-12 col-md-3">
    <div class="card">
      ello
    </div>
  </div>
</div>



<?php include '../components/footer.php'; ?>  