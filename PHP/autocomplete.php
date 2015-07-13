<?php

  /*
  Dieses PHP-File verbindet sich mit der Datenbank mithilfe der angegebenen
  Authentifizierungsdaten. Zuerst wird die Verbindung überprüft. Gab es
  bereits hier einen Fehler, so wird auch eine Fehlermeldung zurückgegeben.

  Zuvor wird allerdings der Key überprüft. Ist dieser nicht rein numerisch,
  so passiert nichts.

  Ansonsten werden aus der Datenbank alle ASCII-Stadtnamen gelesen, bei denen
  die PLZ mit der mitgegebenen beginnt.

  Diese werden dann in JSON-Format umgewandelt und an das JS-File zurückgegeben.
*/
  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'postcodes';
  $key = mysql_real_escape_string($_POST['data']);

  //Falls der Key nicht numerisch ist, tu nichts
  if(!is_numeric($key)){

  }
  else{
    $rows = array();

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      echo ("Datenbank nicht verfügbar");
    }

    $sql = "SELECT `ascii` FROM `geoinfo` WHERE plz LIKE '%" . $key ."%'";

    $result = $conn->query($sql);

    if ($result){

      while($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
      }
    }

    echo(json_encode($rows));
  }
?>
