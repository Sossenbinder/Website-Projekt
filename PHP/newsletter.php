<?php

  /*
    Dieses PHP-File verbindet sich mit der Datenbank mithilfe der angegebenen
    Authentifizierungsdaten. Zuerst wird die Verbindung überprüft. Gab es
    bereits hier einen Fehler, so wird auch eine Fehlermeldung zurückgegeben.

    Ansonsten werden die mitgegebenen Daten einer Sicherheitsprüfung unterzogen
    und dann in die Newsletter-Datenbank eingefügt. Zusätzlich zu den Daten
    wird der MD5Hash eingefügt, und eine "0" unter "Verifiziert".
    
    War dies erfolgreich, wird der Nutzer auf eine Bestätigungsseite
    weitergeleitet.
  */
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
