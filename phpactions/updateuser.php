<?php 

  include 'checksession.php';
  
  if ($admin) {

    $tckno = $_POST['eklekno'];
    $gunceltur = $_POST['eklektip'];
    $guncelad = $_POST['eklekad'];
    $guncelsifre = $_POST['ekleksifre'];

    include '../config/dbconfig.php';

    try {
      

      $mailal = $conn->prepare("SELECT kullanicimail FROM users where kullanicitc = '$tckno'");
      $mailal->execute();
      if ($mailal -> rowCount()) {
        foreach($mailal as $row) {
          if($row['kullanicimail'] != $guncelad) {           
            $mailkontrol = $conn->prepare("SELECT * FROM users where kullanicimail = '$guncelad'");
            $mailkontrol->execute();
            if ($mailkontrol -> rowCount()) {
              $mesaj = 'Bu kullanıcı mevcut';
              header("Location: ../useroperations.php?mesaj=$mesaj");
            } else {
              $query = ("UPDATE users SET kullanicitur='$gunceltur', kullanicimail='$guncelad', kullanicisifre='$guncelsifre' 
              WHERE kullanicitc='$tckno'");
              $conn->exec($query);
              header('Location: ../useroperations.php');
            };

          } else {
            $query = ("UPDATE users SET kullanicitur='$gunceltur', kullanicimail='$guncelad', kullanicisifre='$guncelsifre' 
            WHERE kullanicitc='$tckno'");
            $conn->exec($query);
            header('Location: ../useroperations.php');
          };
        };
      };
  
    } catch(PDOException $e) {
      $mesaj = 'Bu kullanıcı mevcut';
      header("Location: ../useroperations.php?mesaj=$mesaj");
    };

  } else {
    session_destroy();
    header('Location: ../index.php');
  }

  $conn = null;

?>