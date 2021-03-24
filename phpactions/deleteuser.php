<?php 

  include 'checksession.php';
  $silinecek = $_GET['silinecek'];

  if ($admin) {
    
    include '../config/dbconfig.php';
    $query = $conn->prepare("DELETE FROM users where kullanicitc = '$silinecek'");
    $query->execute();
    header('Location: ../useroperations.php');

  } else {
    header('Location: ../index.php');
  }

  $conn = null;

?>