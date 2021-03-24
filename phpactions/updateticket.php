<?php 

  include 'checksession.php';

  if ($admin) {

    include '../config/dbconfig.php';
    
    if (isset($_POST['gdurum'])) {
      $gdurum = $_POST['gdurum'];
      $takipno = $_POST['takipno'];
      $query = ("UPDATE tickets set durum = '$gdurum' WHERE takipno = '$takipno'");
      $conn->exec($query);
      header('Location: ../tickets.php');
    }

    else {
      header('Location: index.php');
      session_destroy();
    }

  }

  $conn = null;

?>