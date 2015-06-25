<?php

  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'postcodes';
  $key = mysql_real_escape_string($_POST['data']);

  if(!is_numeric($key)){
    echo("No valid PLZ");
  }
  else{
    $rows = array();

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      echo ("Datenbank nicht verfügbar");
    }

    //$sql = "SELECT Ortsname FROM postcodes WHERE PLZ LIKE '%" . $_POST['data'] ."%'";
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
