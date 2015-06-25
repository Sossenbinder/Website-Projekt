<?php

  $servername = '';
  $username = '';
  $password = '';
  $dbname = '';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    echo ("Datenbank nicht verfügbar");
  }

  $plz = $_POST['data'];
  echo($plz);
?>
