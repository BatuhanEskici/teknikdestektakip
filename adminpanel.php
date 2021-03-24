<!DOCTYPE html>
<html lang="tr">
<head>
  <?php include 'config/metaconfig.php'; ?>
</head>
<body class="center">
  
  <?php 
  
  include 'phpactions/checksession.php';

  if ($admin) {

    echo "
    <div class='container'>
      <div class='row center'>
        <h3>Yönetim paneli</h3>
      </div>
      <div class='row center'>
        <a href='useroperations.php' class='button button-primary admin-button'>Kullanıcı işlemleri</a>
      </div>
      <div class='row center'>
        <a href='tickets.php' class='button button-primary admin-button'>Teknik destek işlemleri</a>
      </div>
      <div class='row center'>
        <a href='phpactions/logout.php' class='button button-primary'>Çıkış yap</a>
      </div>
    </div>
  ";

  } else {
    header('Location: index.php');
    session_destroy();
  }

  ?>

</body>
</html>