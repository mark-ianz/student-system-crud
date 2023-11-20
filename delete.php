<?php
  include_once ('connection/connection.php');

  $conn = connection(); 
  if (isset($_POST ['delete-button'])) {
    $id = $_POST ['id'];
    
    $sql = "DELETE FROM `student_list` WHERE `student_list`.`id` = $id;";

    $conn->query($sql) or die ($conn->error);

  } 
  header("Location: index.php");
?>