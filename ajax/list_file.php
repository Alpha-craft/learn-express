<?php 
  sleep(1);
  require __DIR__.'/../dist/database.php';

  $uid = $_SESSION['id'];
  $getAttachments = mysqli_query($conn, "SELECT * FROM attachment WHERE author = $uid ORDER BY date_created desc");
  $attId = '';

  while($item = mysqli_fetch_assoc($getAttachments)): 
    $attId = $attId.$item['id'].',';
?>
  <div class="form-check">
    <input class="form-check-input checkbox-file" type="checkbox" value="<?= $item['id'] ?>" id="check-<?= $item['id'] ?>">
    <label class="form-check-label checkbox-label" for="check-<?= $item['id'] ?>">
      <?= $item['file'] ?>
    </label>
  </div>
<?php endwhile; ?>