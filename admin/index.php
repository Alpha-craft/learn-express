<?php 
  require __DIR__.'/../dist/database.php';
  
  $pageTitle = 'Admin Page';
  include __DIR__.'/../components/header.php'; 
?>
      

<?php if(!in_array('admin', $currUserRoles)): ?>
  <?php 
    $alertRole = 'Admin';
    include __DIR__.'/../components/card_alert.php'; 
  ?>
<?php else: $getUsers = mysqli_query($conn, "SELECT * FROM user");  ?>

  <div class="table-responsive">
    <table class="table bg-white align-middle">
      <thead>
        <tr class="table-primary">
          <th scope="col" class="text-nowrap">Nama Pengguna</th>
          <th scope="col" class="text-nowrap">Email</th>
          <th scope="col" class="text-nowrap">Roles</th>   
        </tr>
      </thead>
      <tbody>
        <?php while($user = mysqli_fetch_assoc($getUsers)): $roles = explode(',', $user['role']); ?>
          <?php 
            $checkRoles = [
              'admin' => 0,
              'pengurus' => 0,
              'pengajar' => 0,
              'bendahara' => 0
            ];

            foreach($roles as $val => $key){
              if(in_array($key, array_keys($checkRoles))){
                $checkRoles[$key] = 1;                
              }
            }
          ?>

          <tr>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
              <div class="btn-group btn-group-sm" role="group">
                <?php foreach($checkRoles as $key => $val): ?>
                  <input type="checkbox" class="btn-check" id="check-<?= $user['id'] ?>-<?= $key ?>" autocomplete="off" 
                    <?= $val == 1 ? 'checked' : ''; ?>
                  >
                  <label class="btn btn-outline-primary" for="check-<?= $user['id'] ?>-<?= $key ?>">
                    <?= $key ?>
                  </label>
                <?php endforeach; ?>
              </div>
            </td>
          </tr>
        <?php endwhile; ?>
        <tr class="table-primary">
          <td colspan="3">
            <button class="btn btn-primary btn-sm">
              Simpan Perubahan Akun
            </button>
          </td>
        </tr>
      </tbody>
    </table>  
  </div>

<?php endif?>


<?php include '../components/footer.php'; ?>  