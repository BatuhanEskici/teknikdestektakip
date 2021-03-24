<?php 
  session_start();

  $admin = false;
  $user = false;
  $oturumacikmi = false;

  if (isset($_SESSION['kullanicitur'])) {

    $oturumacikmi = true;

    if ($_SESSION['kullanicitur'] == 0) {
      $admin = true;
      
    } else if ($_SESSION['kullanicitur'] == 1) {
      $user = true;
      $kno = $_SESSION['kullanicitc'];
    }

  } else {
    header('Location: ../index.php');
    session_destroy();
  }

?>