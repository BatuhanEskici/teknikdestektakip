<!DOCTYPE html>
<html lang="tr">
<head>
  <?php include 'config/metaconfig.php'; ?>
  <link rel="stylesheet" href="css/tickets.css">
</head>
<body class="center">
  <?php 

  include 'phpactions/checksession.php';

  if ($oturumacikmi) {
    include 'config/dbconfig.php';

    //Detay ekranında göstermek için parametre olarak yollanan tcyi aldık
    if (isset($_GET['params'])) {
      $params = $_GET['params'];
      $params = explode('/',$params);
      $tno = $params[0];
      $query = $conn->prepare("SELECT * FROM tickets where takipno = '$tno'");
      $query->execute();
      if ($query->rowCount()) {
        foreach ($query as $row) {
          $GLOBALS['takipno'] = $row['takipno'];
          $GLOBALS['urunno'] = $row['urunno'];
          $GLOBALS['kullanicino'] = $row['kullanicino'];
          $GLOBALS['durum'] = $row['durum'];
          $GLOBALS['mesaj'] = $row['mesaj'];
          $GLOBALS['fotograf'] = $row['fotograf'];
        }
      }
    };
  };

  if ($user) {

    echo"
      <div class='container'>

        <div class='row center'>
          <h4>Teknik destek talepleri</h4>
        </div>

        <div class='row center'>
          <table class='u-full-width'>
          <thead>
            <tr>
              <th>Takip no</th>
              <th>Ürün no</th>
              <th>Durum</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody>";

            $query = $conn->prepare("SELECT takipno, urunno, durum FROM tickets where kullanicino = '$kno'");
            $query->execute();
            if ($query -> rowCount()) {
              foreach ($query as $row) {
                echo "<tr>";
                  echo "<td>";
                    echo $row['takipno'];
                  echo "</td>";
                  echo "<td>";
                    echo $row['urunno'];
                  echo "</td>";
                  echo "<td>";
                    echo $row['durum'];
                  echo "</td>";
                  echo "<td>";
                    echo "<button class='button-primary showModal user'>Detay göster</button>";
                  echo "</td>";
                echo "</tr>";
              };
            }
            
          echo"</tbody>
        </table>
        </div>

        <!-- The Modal -->
        <div id='myModal' class='modal'>
    
          <!-- Modal content -->
          <div class='modal-content'>
    
            <span class='close'>&times;</span>
    
            <div class='row'>
              <p><span class='detailheader'>Takip numarası: </span><span id='dtakip'></span></p>
            </div>
    
            <div class='row'>
              <p><span class='detailheader'>Ürün numarası: </span><span id='durun'></span></p>
            </div>
    
            <div class='row'>
              <p><span class='detailheader'>Durum: </span><span id='ddurum'></span></p>
            </div>
    
            
            <div class='row'>";
              echo "<p><span class='detailheader'>Mesaj: </span>";
                echo $mesaj;
              echo "</p>";
              echo"
            </div>
            
            <div class='row'>"; 
              echo "<p><span class='detailheader'>Fotoğraf: </span> </br>";
              echo "<div class='center'>";
                echo '<img src="'.$fotograf.'" class="detailimg">';
              echo "</div>";
              echo "</p>";
            echo"
            </div>
    
          </div>
    
        </div>

        <div class='row center'>
          <a href='phpactions/logout.php' class='button button-primary'>Çıkış yap</a>
        </div>

      </div>  
    ";

  } else if($admin) {

    echo"
    <div class='container'>

      <div class='row center'>
        <h4>Teknik destek talepleri</h4>
      </div>

      <div class='row center'>
        <table class='u-full-width'>
        <thead>
          <tr>
            <th>Takip no</th>
            <th>Ürün no</th>
            <th>Durum</th>
            <th>İşlemler</th>
          </tr>
        </thead>
        <tbody>";

          include 'config/dbconfig.php';
          $query = $conn->prepare("SELECT * FROM tickets");
          $query->execute();
          if ($query -> rowCount()) {
            foreach ($query as $row) {
              echo "<tr>";
                echo "<td>";
                  echo $row['takipno'];
                echo "</td>";
                echo "<td>";
                  echo $row['urunno'];
                echo "</td>";
                echo "<td>";
                  echo $row['durum'];
                echo "</td>";
                echo "<td>";
                  echo "<button class='button-primary showModal admin'>Talebi güncelle</button>";
                echo "</td>";
              echo "</tr>";
            };
          }
          
        echo"</tbody>
      </table>
      </div>

      <!-- The Modal -->
      <div id='myModal' class='modal'>
  
        <!-- Modal content -->
        <div class='modal-content'>
  
          <span class='close'>&times;</span>
  
          <form action='phpactions/updateticket.php' method='POST'>
            <div class='row'>
              <p><span class='detailheader'>Takip numarası: </span>"; echo '<input class="disabled" type="text" name="takipno" value="'.$takipno.'">'; echo"</p>
            </div>
    
            <div class='row'>
            <p><span class='detailheader'>Ürün numarası: </span>"; echo '<input class="disabled" type="text" value="'.$urunno.'">'; echo"</p>
            </div>

            <div class='row'>
            <p><span class='detailheader'>Kullanıcı numarası: </span>"; echo '<input class="disabled" type="text" value="'.$kullanicino.'">'; echo"</p>
            </div>
    
            <div class='row'>
              <p><span class='detailheader'>Durum: </span>"; echo '<input  class="u-full-width" type="text" name="gdurum" value="'.$durum.'">'; echo"</p>
            </div>
    
            
            <div class='row'>";
              echo "<p><span class='detailheader'>Mesaj: </span>";
                echo $mesaj;
              echo "</p>";
              echo"
            </div>
            
            <div class='row'>"; 
              echo "<p><span class='detailheader'>Fotoğraf: </span> </br>";
              echo "<div class='center'>";
                echo '<img src="'.$fotograf.'" class="detailimg">';
              echo "</div>";
              echo "</p>";
            echo"
            </div>

            <div class='row center'>
              <input type='submit' class='button button-primary' value='Güncelle'>
            </div>
          </form>
  
        </div>
  
      </div>

      <div class='row center'>
        <a href='adminpanel.php' class='button button-primary admin-userbutton'>Yönetim paneli</a>
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

  $conn = null;

  ?>

  <script src="js/tickets.js"></script>

</body>
</html>