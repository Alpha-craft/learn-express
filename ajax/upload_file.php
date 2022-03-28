<?php
require '../dist/database.php';

if(isset($_FILES['files']['name'])){
  $response = 0;
  $insert = '';

  foreach($_FILES['files']['name'] as $i => $filename){ 
    if($_FILES['files']['size'][$i] < 8388608){
      if(move_uploaded_file($_FILES['files']['tmp_name'][$i], __DIR__.'/../upload/'.$filename)){
        $comma = ($i+1) != count($_FILES['files']['name']) ? ',' : '';
        $author = $_SESSION['id'];
        $insert .= "(null, '$filename', '$author', '$now')$comma" ; 

      } else{
        $response = 1;
      }
    }else{
      $response = 2;
    }
  }  
  
  if($response == 0){
    mysqli_query($conn, "INSERT INTO attachment(id, file, author, date_created) VALUES$insert");   
  }
  
  echo $response;
  exit();
}
?>