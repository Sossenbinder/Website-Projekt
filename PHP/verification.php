<?php

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
