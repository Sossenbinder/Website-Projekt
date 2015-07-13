<?php
  /*
  Dieses PHP-File verbindet sich mit der Datenbank mithilfe der angegebenen
  Authentifizierungsdaten. Zuerst wird die Verbindung überprüft. Gab es
  bereits hier einen Fehler, so wird auch eine Fehlermeldung zurückgegeben.

  Ansonsten wird der Verifikations-key aus der aus der Email weitergeleiteten
  URL ausgelesen. Dieser wird auf Sicherheit überprüft.

  Danach wird in der Datenbank nach diesem Key gesucht. Existiert er, so wird
  der Wert des Eintrags auf der entsprechenden Zeile auf 1 gesetzt - Der Nutzer
  ist jetzt verifiziert.
  */
  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'newsletterdata';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    echo ("Datenbank nicht verfügbar");
  }

  $verification = $_GET['verification'];

  $verification = mysql_real_escape_string($verification);

  $connnew = new mysqli($servername, $username, $password, $dbname);
  $sqlnew = "UPDATE subscriptiondetails SET Verifiziert = 1 WHERE VerificationCode = '$verification'";
  $resultnew = $connnew->query($sqlnew);

  if($resultnew===TRUE){
    require("danke.php");
  }

  $connnew->close();
  $conn->close();
?>
