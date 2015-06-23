<?php

  $servername1 = "loca";
  $servername2 = "lhost";
  $servername = $servername1.$servername2;

  $username1 = "ro";
  $username2 = "ot";
  $username = $username1.$username2;

  $password1 = "lore";
  $password2 = "ntz1";
  $password3 = "234";
  $password = $password1.$password2.$password3;

  $dbname1 = "news";
  $dbname2 = "letter";
  $dbname3 = "data";
  $dbname = $dbname1.$dbname2.$dbname3;

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO subscriptiondetails (Email, Nachname, Vorname)
          VALUES ($email, $name, $vorname)";

  if ($conn->query($sql) === TRUE) {
      echo "Entry created";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
?>
