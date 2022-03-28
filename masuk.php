<?php
require 'dist/database.php';

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $image = '';
  $role = isset($_POST['uid']) && $_POST['uid'] == "123" ? 'pengajar' : 'murid';

  $user = get_user($conn, 'email', "'".$email."'");

  if($email == '' || $pass == ''){
    $alert = 'Masukkan email dan password';

  }
  elseif($user == null){
    $alert = 'Email belum didaftarkan';

  } else{    
    if(password_verify($pass, $user['password'])){
      $_SESSION['id'] = $user['id'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['name'] = $user['name'];
      header("location: /");

    } else{
      $alert = 'Password salah';
    }
  }
}

$pageTitle = 'Masuk';

include 'components/header_form.php';
?>



<div class="form-group mb-3">
  <label class="form-label">Email</label>
  <input class="form-control" type="text" name="email" placeholder="masukan email">
</div>

<div class="form-group mb-3">
  <label class="form-label">Kata Sandi</label>
  <input class="form-control" type="password" name="password" placeholder="masukan password">
</div>

<?php if(isset($alert)): ?>
  <div class="mb-3 text-danger">
    *<?= $alert ?>
  </div>
<?php endif; ?>

<div class="text-end mt-5 mb-3">
  <a href="">Lupa password?</a>
</div>

<button class="d-block w-100 btn btn-primary mb-3" type="submit" name="submit">
  Login
</button>

<div class="text-center">
  <span>Belum punya akun?</span>
  <a href="/daftar.php">Daftar sekarang</a>
</div>
                        


<?php include 'components/footer_form.php';?> 