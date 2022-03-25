<?php
  ob_start();
  session_start();
  date_default_timezone_set("Asia/Jakarta");

  $now = date('Y-m-d H:i:s'); 

  function get_user($conn, $by, $value){
    $get = mysqli_query($conn, "SELECT * FROM user WHERE $by = $value");

    return mysqli_fetch_assoc($get);
  }
  
  function get_formatted_date($date, $format){
    $dateObj = new DateTime($date);

    return date_format($dateObj, $format == '' ? 'd M Y H:i:s' : $format);
  }

  $conn = mysqli_connect(
    "localhost", 
    "root", 
    "", 
    "ramadhan_karim"
  );


?>