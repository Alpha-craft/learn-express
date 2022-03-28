<?php 
  require 'dist/database.php';
  include 'components/header.php'; 

  $author = $_SESSION['id'];

  $getTasks = mysqli_query($conn, 
    "SELECT *, (
      SELECT 1
      FROM submission AS t
      WHERE t.task = v.id
        AND t.author = $author
    ) AS is_done
  FROM task AS v");

  
  echo mysqli_error($conn);

  echo '<pre>';
    while($task = mysqli_fetch_assoc($getTasks)){
      print_r($task);
    }  
  echo '</pre>';
?>
      



<?php include 'components/footer.php'; ?>  