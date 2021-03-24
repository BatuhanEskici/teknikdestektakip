<?php 
session_start();

  if($_POST) {
    $kad = $_POST['kad'];
    $sifre = $_POST['sifre'];
  }

  include '../config/dbconfig.php';

  try {
    $query = $conn->prepare("SELECT * FROM users where kullanicimail = '$kad' AND kullanicisifre = '$sifre'");
    $query->execute();
  
    if ($query -> rowCount()) {
      foreach($query as $row) {
        $_SESSION['kullanicino'] = $row['kullanicitc'];
        if ($row['kullanicitur'] == 0) {
          $_SESSION['kullanicitur'] = '0';
          header('Location: ../adminpanel.php');
        } else {
          $_SESSION['kullanicitur'] = '1';
          $_SESSION['kullanicitc'] = $row['kullanicitc'];
          header('Location: ../tickets.php');
        }
      }
    } else {
      $mesaj = 'Böyle bir kullanıcı mevcut değil';
      header("Location: ../index.php?mesaj=$mesaj");
    }

  } catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }

  $conn = null;

?>