<!DOCTYPE html>
<html lang="tr">
<head>
  <?php include 'config/metaconfig.php'; ?>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
</head>
<body class="center">
  
  <?php 

    if (isset($_GET['mesaj'])) {
      $mesaj = $_GET['mesaj'];
      echo "<script type='text/javascript'>alert('$mesaj');</script>";
    }

    include 'phpactions/checksession.php';

    if ($admin) {

      echo "
      <div class='container'>

        <div class='row center'>
          <h4>Kullanıcılar</h4>
        </div>

        <div class='row center'>
          <table class='u-full-width' id='user-table'>
            <thead>
              <tr>
                <th>Kullanıcı no</th>
                <th>Kullanıcı türü</th>
                <th>Kullanıcı ad</th>
                <th>Kullanıcı şifre</th>
                <th>İşlemler</th>
              </tr>
            </thead>
            <tbody>";

              include 'config/dbconfig.php';
              $query = $conn->prepare("SELECT * FROM users");
              $query->execute();
              if($query -> rowCount()) {
                foreach($query as $row) {
                  echo "<tr>";
                    echo "<td>";
                      echo $row['kullanicitc'];
                      $silinecek = $row['kullanicitc'];
                    echo "</td>";
                    echo "<td>";
                      if ($row['kullanicitur'] == 0) {
                        echo "Admin";
                      } else {
                        echo "Kullanıcı";
                      }
                    echo "</td>";
                    echo "<td>";
                      echo $row['kullanicimail'];
                    echo "</td>";
                    echo "<td>";
                      echo $row['kullanicisifre'];
                    echo "</td>";
                    echo "<td>";
                      echo "<a href='#' class='table-button btn-delete'><i class='fas fa-trash-alt'></i></a>";
                      echo "<a href='#' class='table-button btn-edit'><i class='fas fa-edit'></i></a>";
                    echo "</td>";
                  echo "</tr>";
                };
              }

            echo"</tbody>
          </table>
        </div>

        <div class='row center'>
          <a href='adminpanel.php' class='button button-primary admin-userbutton'>Yönetim paneli</a>
        </div>

        <div class='row center'>
          <button id='adduserbutton' class='button-primary admin-userbutton'>Yeni kullanıcı ekle</button>
        </div>

        <div class='row center'>
          <a href='phpactions/logout.php' class='button button-primary'>Çıkış yap</a>
        </div>

        <div class='row'>
          <form action='#' method='POST' id='adduserform' class='u-full-width' style='margin-top: 1rem;'>
            <label for='eklekno'>Tc kimlik numarası</label>
            <input type='text' class='u-full-width' name='eklekno' id='eklekno'>
            <label for='eklektip'>Kullanıcı türünü seçin</label>
            <select class='u-full-width' id='eklektip' name='eklektip'>
              <option value='0'>Admin</option>
              <option value='1'>Kullanıcı</option>
            </select>
            <label for='eklekad'>Kullanıcı adı</label>
            <input type='text' class='u-full-width' name='eklekad' id='eklekad'>
            <label for='ekleksifre'>Kullanıcı şifresi</label>
            <input type='password' class='u-full-width' name='ekleksifre' id='ekleksifre'>
            <div class='center'>
              <input type='submit' class='button-primary' id='kaydetguncelle' value='Kaydet'>
            </div>
          </form>

        </div>

      </div>
    ";

    } else {
      header('Location: index.php');
      session_destroy();
    }

    $conn = null;

  ?>

  <script src="js/useroperations.js"></script>

</body>
</html>