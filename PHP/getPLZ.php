<?php
  /*
  Dieses PHP-File verbindet sich mit der Datenbank mithilfe der angegebenen
  Authentifizierungsdaten. Zuerst wird die Verbindung überprüft. Gab es
  bereits hier einen Fehler, so wird auch eine Fehlermeldung zurückgegeben.

  Zuvor wird allerdings der Key überprüft. Ist dieser nicht dem Regex
  entsprechend, so passiert nichts.

  Ansonsten wird für die eingegebene Stadt eine Anfrage ausgeführt, die die PLZ
  zurückgibt (wenn diese vorhanden ist).
  */
  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'postcodes';
  $key = mysql_real_escape_string($_POST['data']);

  if(!preg_match("/^[a-zA-Z]+$/", $key)){

  }
  else{
    $rows = array();

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      echo ("Datenbank nicht verfügbar");
    }

    $sql = "SELECT `plz` FROM `geoinfo` WHERE ascii LIKE '$key'";

    $result = $conn->query($sql)->fetch_object()->plz;

    echo($result);
  }
?>
