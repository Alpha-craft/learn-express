<?php
ob_start();
session_start();

if(!isset($_SESSION['email'])){
  header("location: /");
}

$file = 'upload/'.$_GET['q'];

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($file).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;
?>