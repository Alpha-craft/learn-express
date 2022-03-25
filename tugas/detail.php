<?php 
  require __DIR__.'/../dist/database.php'; 
  $taskId = $_GET['q'] ?? null;

  if($taskId == null){
    header("location: /tugas");
  }

  $getTask = mysqli_query($conn, "SELECT * FROM task WHERE id = $taskId");
  $task = mysqli_fetch_assoc($getTask);

  $pageTitle = $task['title'];

  include '../components/header.php';   
?>
      

<div class="row">
  <div class="col-8">
    <div class="card">
      <div class="card-body">
        <div class="d-flex align-items-center mb-3">
          <h4 class="mb-0">Judul tugas</h4>
          <span class="badge bg-dark text-uppercase p-2 ms-auto">Category</span>      
        </div>    
        <div class="row mb-3">
          <div class="col-auto">
            <small class="text-muted">Dibuat pada 22 Mar 2022</small>
            <!-- <div class="d-flex flex-wrap align-content-center mb-2">
              <div class="me-3">
                <div class="text-muted">Dibuka pada:</div>
                <div class="fw-bold p-1 px-2 bg-info text-nowrap rounded text-light">
                  21 Mar 2022 11:05:36
                </div>
              </div>                  
              <div class="me-3">
                <div class="text-muted">Ditutup pada:</div>
                <div class="fw-bold p-1 px-2 bg-danger text-nowrap rounded text-light">
                  26 Mar 2022 11:05:36
                </div>
              </div>                  
            </div> -->
          </div>
          <div class="col-auto ms-auto">
            <span class="badge bg-danger p-2">
              <i class="las la-clock"></i>
              25 Mar 2022 03:00:00
            </span>
          </div>
        </div>
        <div class="mb-3">
          <small>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus suscipit magnam minima amet vitae enim veniam nihil mollitia. Commodi mollitia optio corporis sit soluta libero rem nihil placeat velit in?</small>
          <button class="btn btn-primary w-100"><i class=""></i>Add attachment</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      ello
    </div>
  </div>
</div>


<?php include '../components/footer.php'; ?>  