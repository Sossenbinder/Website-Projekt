<?php

  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'vorlesung';
  $result = '';

  $rows = array();

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    echo ("Datenbank nicht verfügbar");
  }

  $sql = "SELECT Ortsname FROM postcodes WHERE PLZ LIKE '%" . $_POST['data'] ."%'";

  $result = $conn->query($sql);

  if ($result){

    while($r = mysqli_fetch_assoc($result)) {
      $rows[] = $r;
    }
  }

  echo(json_encode($rows));
?>
