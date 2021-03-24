<?php 

  include 'checksession.php';

  if($admin) {

    $ekletc = $_POST['eklekno'];
    $ekletur = $_POST['eklektip'];
    if ($ekletur == 'admin') {
      $ekletur = 0;
    } else if ($ekletur == 'user') {
      $ekletur = 1;
    }
    $eklead = $_POST['eklekad'];
    $eklesifre = $_POST['ekleksifre'];

    include '../config/dbconfig.php';

    try {

      $query = $conn->prepare("SELECT * FROM users where kullanicimail = '$eklead'");
      $query->execute();
      if ($query -> rowCount()) {
        $mesaj = 'Bu kullanıcı mevcut';
        header("Location: ../useroperations.php?mesaj=$mesaj");
      } else {
        $query = ("INSERT INTO users VALUES('$ekletc', '$ekletur', '$eklead', '$eklesifre')");
        $conn->exec($query);
        header('Location: ../useroperations.php');
      }
  
    } catch(PDOException $e) {
      $mesaj = 'Bu kullanıcı mevcut';
      header("Location: ../useroperations.php?mesaj=$mesaj");
    };

  } else {
    header('Location: ../index.php');
    session_destroy();
  };

  $conn = null;

?>