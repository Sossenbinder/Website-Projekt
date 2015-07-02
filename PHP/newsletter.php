<?php

  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'newsletterdata';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    echo ("Datenbank nicht verfügbar");
  }

  $email = mysql_real_escape_string($email);
  $name = mysql_real_escape_string($name);
  $vorname = mysql_real_escape_string($vorname);
  $anrede = mysql_real_escape_string($anrede);

  $sql = "INSERT INTO subscriptiondetails (Email, Nachname, Vorname, Anrede, VerificationCode, Verifiziert)
          VALUES ('$email', '$name', '$vorname', '$anrede', '$md5hash', '0')";

  if ($conn->query($sql) === TRUE) {
      echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=".$danke."\">";
  }

  $conn->close();
?>
