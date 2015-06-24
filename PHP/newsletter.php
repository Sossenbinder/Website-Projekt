<?php

  $servername1 = 'loca';
  $servername2 = 'lhost';
  $servername = $servername1.$servername2;

  $username1 = 'ro';
  $username2 = 'ot';
  $username = $username1.$username2;

  $password1 = 'lore';
  $password2 = 'ntz1';
  $password3 = '234';
  $password = $password1.$password2.$password3;

  $dbname1 = 'news';
  $dbname2 = 'letter';
  $dbname3 = 'data';
  $dbname = $dbname1.$dbname2.$dbname3;

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $email = mysql_real_escape_string($email);
  $name = mysql_real_escape_string($name);
  $vorname = mysql_real_escape_string($vorname);
  $anrede = mysql_real_escape_string($anrede);

  $sql = "INSERT INTO subscriptiondetails (Email, Nachname, Vorname, Anrede)
          VALUES ('$email', '$name', '$vorname', '$anrede')";

  if ($conn->query($sql) === TRUE) {
      echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=".$danke."\">";
  }

  $conn->close();
?>
