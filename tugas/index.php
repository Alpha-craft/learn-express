<?php 
  require __DIR__.'/../dist/database.php';
  
  $author = $_SESSION['id'];

  $getTasks = mysqli_query($conn, 
    "SELECT *, (
      SELECT 1
      FROM submission AS t
      WHERE t.task = v.id
        AND t.author = $author
    ) AS is_done
  FROM task AS v ORDER BY date_created DESC");

  $sortedTasks = [];
  while($item = mysqli_fetch_assoc($getTasks)){ 
    if(!in_array($item['category'], array_keys($sortedTasks))){
      $sortedTasks[$item['category']] = [$item];
      
    } else{
      array_push($sortedTasks[$item['category']], $item);
    }
  }

  $pageTitle = 'Daftar tugas';
  include '../components/header.php';   
?>


<div class="text-center mb-4">
  <h3>Daftar Tugas</h3>
</div>

<div x-data="{opened: -1}">
  <ul class="nav nav-tabs d-flex flex-nowrap scroll-horizontal border-bottom-0">
    <li class="nav-item order-first">
      <a class="nav-link text-dark cursor-pointer text-nowrap" :class="{'active': -1 == opened}" x-on:click="opened = -1">
        Semua
      </a>
    </li>
    <?php foreach (array_keys($sortedTasks) as $i => $value): ?>
      <li class="nav-item <?= $value == '' ? 'order-last' : '' ?>">
        <a class="nav-link text-dark cursor-pointer text-nowrap" :class="{'active': <?=$i?> == opened}" x-on:click="opened = <?=$i?>">
          <?= $value == '' ? 'Tugas Lainnya' : $value ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>

  <div class="card">
    <div class="card-body">
      <?php $x=0; foreach ($sortedTasks as $category => $tasks): ?>
        <div class="mb-5" x-show="opened == <?= $x ?> || opened == -1" x-cloak>
          <?php if($category): ?>
            <h3 class="fs-3 border-exam-side mb-1 py-2"><?= $category ?></h4>
          <?php endif; ?>
          <?php $y=0; foreach ($tasks as $task): $author = get_user($conn, 'id', $task['author']); ?>
            <a href="/tugas/detail.php?q=<?= $task['id'] ?>"
                class="d-block text-dark hover-basic p-3 border text-decoration-none
                  <?= $y != 0 ? 'border-top-0' : '' ?> 
                  <?= $task['is_done'] == 1 ? 'bg-green-lt' : '' ?>
            ">
              <h4 class="fs-5 fw-bold mb-2"><?= $task['title'] ?></h4>
              <div class="mb-2">
                <small class="d-block text-muted">Pengajar: <?= $author['name'] ?></small>
                <small class="d-block">Dibuat pada: <?= get_formatted_date($task['date_created'], '') ?></small>
              </div>
              <div class="d-flex flex-wrap align-content-center mb-2">
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
            </a>
          <?php $y+=1; endforeach; ?>
        </div>                    
      <?php $x+=1; endforeach; ?>
    </div>
  </div> 
</div>     


<?php include '../components/footer.php'; ?>  