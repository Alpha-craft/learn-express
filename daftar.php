<?php
require 'dist/database.php';

if(isset($_POST['confirm'])){
  $name = $_POST['username'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $image = '';

  $isSameEmail = get_user($conn, 'email', "'".$email."'");

  if($name == '' || $pass == '' || $email == ''){
    $alert = 'Isi setidaknya nama pengguna, email dan password!';

  } elseif($isSameEmail != null){
    $alert = 'Email telah dipakai, tolong pakai email lain';

  } else{
    $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_query($conn, 
      "INSERT INTO user(id, name, email, password, role, image, date_created) 
        VALUES(null, '$name', '$email', '$hashedPass', 'pending', '$image', '$now')"
    );

    header("location: /masuk.php");
  }

}

$pageTitle = 'Daftar';
include 'components/header_form.php';
?>


<div class="form-group mb-3">
  <label class="form-label">Nama Pengguna</label>
  <input class="form-control" type="text" name="username" placeholder="masukan nama pengguna">
</div>
<div class="form-group mb-3">
  <label class="form-label">Email</label>
  <input class="form-control" type="text" name="email" placeholder="masukan email">
</div>
<div class="form-group mb-3">
  <label class="form-label">Kata Sandi</label>
  <input class="form-control" type="password" name="password" placeholder="masukan password">
</div>
<div class="form-group mb-3">
  <label class="form-label">Ulangi Kata Sandi</label>
  <input class="form-control" type="password" name="konfirmasi" placeholder="masukan password">
</div>

<?php if(isset($alert)): ?>
  <div class="mb-3 text-danger">
    *<?= $alert ?>
  </div>
<?php endif; ?>

<button class="d-block w-100 btn btn-primary mt-5 mb-3" type="submit" name="confirm">
  Login
</button>

<div class="text-center">
  <span>Sudah punya akun?</span>
  <a href="/masuk.php">Masuk</a>
</div>

<?php include 'components/footer_form.php'; ?>