<!DOCTYPE html>
<html lang="tr">
<head>
  <?php include 'config/metaconfig.php'; ?>
</head>
<body class="center">
  
  <div class="container center">

    <div class="main-form">
      <h3>Oturum aç</h3>

      <form action="phpactions/login.php" method="POST" id="login-form">
        <div class="row">
          <input type="text" id="kad" name="kad" placeholder="Kullanıcı adı:" minlength="4" maxlength="20">
        </div>
        <div class="row">
          <input type="password" id="sifre" name="sifre" placeholder="Şifre:" minlength="4" maxlength="20">
        </div>
        <div class="row center">
          <input type="submit" class="button-primary" value="Giriş">
        </div>
        <div class="info-box row center">
        <?php if(isset($_GET['mesaj'])) {$mesaj = $_GET['mesaj'];} else {$mesaj = '';} ?>
        <?php if($mesaj != ''): ?>
          <script>
            document.querySelector('.info-box').style.visibility = 'visible';
            setTimeout(() => {
              document.querySelector('.info-box').style.visibility = 'hidden';
            }, 2000);
          </script>
          <?php echo $mesaj; ?>
          <?php else: ?>
          <script>document.querySelector('.info-box').style.visibility = 'hidden';</script>
        <?php endif ?>
        </div>
      </form>

    </div>

  </div>

</body>
</html>