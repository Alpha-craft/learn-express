<?php  
  $getAtt = mysqli_query($conn, "SELECT * FROM attachment WHERE id IN ($att)");
?>


<div class="card mb-4">
  <div class="card-header">
    File Attachment
  </div>
  <div class="card-body p-0">
    <?php while($item = mysqli_fetch_assoc($getAtt)): ?>
      <a href="/download.php?q=<?= $item['file'] ?>" class="d-block text-left btn btn-outline-primary border-0 rounded-0">
        <?= $item['file'] ?>
      </a>                          
    <?php endwhile; ?>
  </div>            
</div>