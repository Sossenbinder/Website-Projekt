<?php

  $servername = 'localhost';
  $username = 'root';
  $password = 'lorentz1234';
  $dbname = 'newsletterdata';

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    echo ("Datenbank nicht verfügbar");
  }

  $name = $_GET['name'];
  $vorname = $_GET['vorname'];
  $verification = $_GET['verification'];

  $name = mysql_real_escape_string($name);
  $vorname = mysql_real_escape_string($vorname);
  $verification = mysql_real_escape_string($verification);

  $sql = "SELECT `VerificationCode` FROM `subscriptiondetails` WHERE Vorname LIKE '$vorname' AND Nachname LIKE '$name'";

  $result = $conn->query($sql);

  if ($result) {

      $resultnew = $result->fetch_object()->VerificationCode;

      if($resultnew == $verification){

        $connnew = new mysqli($servername, $username, $password, $dbname);
        $sqlnew = "UPDATE subscriptiondetails SET Verifiziert = 1 WHERE VerificationCode = '$verification'";
        $resultnew = $connnew->query($sqlnew);

        if($resultnew===TRUE){
          require("danke.php");
        }
      }
  }
  $connnew->close();
  $conn->close();
?>
