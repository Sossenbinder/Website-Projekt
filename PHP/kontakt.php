<div class="siteContent">

<?php
  error_reporting(E_ERROR | E_PARSE);

  @require('config.php');

  if ($_POST['delete']) {
    unset($_POST);
  }

  if ($_POST["kf-km"]) {
    $anrede         = $_POST["anrede"];
    $vorname        = $_POST["vorname"];
    $name           = $_POST["name"];
    $adresse        = $_POST["adresse"];
    $plz            = $_POST["plz"];
    $ort            = $_POST["ort"];
    $telefon        = $_POST["telefon"];
    $email          = $_POST["email"];
    $betreff        = $_POST["betreff"];
    $nachricht      = $_POST["nachricht"];
    $firma          = $_POST["firma"];
    $anrede         = stripslashes($anrede);
    $vorname        = stripslashes($vorname);
    $name           = stripslashes($name);
    $email          = stripslashes($email);
    $betreff        = stripslashes($betreff);
    $nachricht      = stripslashes($nachricht);

    if (!$anrede == "Herr" || !$anrede == "Frau") {
      $fehler['anrede']   = "<font color=#cc3333>Bitte w&auml;hlen Sie eine
                      <strong>Anrede</strong> aus.<br /></font>";
      unset($anrede);
    }

    if(!preg_match("/^[a-zA-Z]+$/", $vorname)) {
      $fehler['vorname']  = "<font color=#cc3333>Geben Sie bitte Ihren
                      <strong>Vornamen</strong> ein.<br /></font>";
      unset($vorname);
    }

    if(!preg_match("/^[a-zA-Z]+$/", $name)) {
      $fehler['name']     = "<font color=#cc3333>Geben Sie bitte Ihren
                      <strong>Nachnamen</strong> ein.<br /></font>";
      unset($name);
    }

    if(!preg_match("/^[a-zA-Z]+\ +[0-9]+$/", $adresse) && $betreff!='Newsletter') {
      $fehler['adresse']  = "<font color=#cc3333>Geben Sie bitte Ihre
                      <strong>Adresse</strong> ein.<br /></font>";
      unset($anrede);
    }

    if(!preg_match("/^[0-9]+$/", $plz) && $betreff!='Newsletter') {
      $fehler['plz']   = "<font color=#cc3333>Geben Sie bitte die
                      <strong>PLZ</strong> ein.<br /></font>";
      unset($plz);
    }

    if(!preg_match("/^[a-zA-Z]+$/", $ort) && $betreff!='Newsletter') {
      $fehler['ort']   = "<font color=#cc3333>Geben Sie bitte den
                      <strong>Ort</strong> ein.<br /></font>";
      unset($ort);
    }

    if (!preg_match("/^\S+@\S+\.\S+$/", $email)) {
      $fehler['email']    = "<font color=#cc3333>Geben Sie bitte Ihre
                      <strong>E-Mail-Adresse</strong> ein.\n<br /></font>";
      unset($email);
    }

    if(!$betreff=="Newsletter" && !$betreff=="Angebotsanfrage" && !$betreff=="Infomaterial") {
     $fehler['betreff']    = "<font color=#cc3333>Bitte waehlen Sie einen
                      <strong>Betreff</strong>.<br /></font>";
     unset($betreff);
    }

    if(!$nachricht && $betreff!='Newsletter') {
     $fehler['nachricht']  = "<font color=#cc3333>Geben Sie bitte eine
                      <strong>Nachricht</strong> ein.<br /></font>";
     unset($nachricht);
    }

    if(!preg_match("/^[0-9]+\/+[0-9]+$/", $telefon) && $betreff!='Newsletter'){
      $fehler['telefon']   = "<font color=#cc3333>Geben Sie bitte eine
      <strong>Telefonnummer</strong> ein.<br /></font>";
      unset($telefon);
    }

    if($firma){
      if(!preg_match("/^[a-zA-Z0-9]+$/", $firma)){
        unset($firma);
      }
    }

    if ($anrede && $vorname && $name && $adresse && $ort && $plz && $telefon && $email && $betreff && $nachricht && $betreff!='Newsletter'){

      $mail1="piano.lo";
      $mail2="rentz@g";
      $mail3="mail.com";

      $headers = "From: "." <".$email.">";

      $nachricht .= "\n\n\nBitte melden sie sich bei mir: \n".$adresse." ".$plz." ".$ort."\nOder auch telefonisch: ".$telefon;
      $nachricht .= "\n\nMit freundlichen Grueßen,\n".$anrede." ".$vorname." ".$name;

      if($firma){
        $nachricht .= "\nVon der Firma: ".$firma;
      }

      if(mail($mail1.$mail2.$mail3, wordwrap( $betreff, 100, "\n" ), $nachricht, $headers)){
        echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=".$danke."\">";
      };
    }
    elseif($anrede && $vorname && $name && $email && $betreff=='Newsletter'){
      include('newsletter.php');
    }
  }
?>

<div class="kontaktformular" id="ktf">
  <link rel="stylesheet" type="text/css" href="../CSS/general.css">
  <link rel="stylesheet" type="text/css" href="../CSS/kontakte.css">

  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">

    <fieldset class="kontaktdaten">
      <legend>Kontaktdaten</legend>
      <table>
		    <tr>
          <td class="label"><label>Anrede: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["anrede"] != "") { echo $fehler["anrede"]; } ?>
            <select style="width: 70px;" name="anrede" <?php if ($fehler["anrede"] != "") { echo 'class="errordesignfields"'; } ?>>
              <option selected="selected" value="0"></option>
              <option value="Herr" <?php if($anrede=="Herr"){ echo "selected";}?>>Herr</option>
              <option value="Frau" <?php if($anrede=="Frau"){ echo "selected";}?>>Frau</option>
            </select>
          </td>
        </tr>

		    <tr>
		      <td class="label"><label>Vorname: <span class="pflichtfeld">*</span></label></td>
          <td class="field"><?php if ($fehler["vorname"] != "") { echo $fehler["vorname"];} ?>
            <input type="text" name="vorname" maxlength="<?php echo $zeichenlaenge_vorname; ?>" value="<?php echo $vorname; ?>"
            <?php if($fehler["vorname"] != "") {echo 'class="errordesignfields"';} ?>/>
          </td>
		    </tr>

		    <tr>
          <td class="label"><label>Nachname: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if($fehler["name"] != "") { echo $fehler["name"];} ?>
            <input type="text" name="name" maxlength="<?php echo $zeichenlaenge_name; ?>" id="textfield" value="<?php echo $name; ?>"
            <?php if ($fehler["name"] != "") { echo 'class="errordesignfields"'; } ?>/>
          </td>
		    </tr>

        <tr>
          <td class="label"><label>Adresse: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["adresse"] != "") { echo $fehler["adresse"]; } ?>
            <input type="text" name="adresse" maxlength="<?php echo $zeichenlaenge_email; ?>" value="<?php echo $adresse; ?>"
            <?php if ($fehler["adresse"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
        </tr>

        <tr>
          <td class="label"><label>PLZ: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["plz"] != "") { echo $fehler["plz"]; } ?>
            <input type="text" id="plzField" name="plz" maxlength="<?php echo $zeichenlaenge_plz; ?>" value="<?php echo $plz; ?>"
            <?php if ($fehler["plz"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
        </tr>

        <tr>
          <td class="label"><label>Ort: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["ort"] != "") { echo $fehler["ort"]; } ?>
            <input type='text' name="ort" list="cityDropDown" id="cityListInput" oninput="getPLZ(document.getElementById('cityListInput').value)" value="<?php echo $ort; ?>">
            <datalist id="cityDropDown">
            </datalist>
        </tr>

        <tr>
          <td class="label"><label>Telefon: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
             <?php if ($fehler["telefon"] != "") { echo $fehler["telefon"]; } ?>
            <input type="text" name="telefon" maxlength="<?php echo $zeichenlaenge_telefon; ?>" value="<?php echo $telefon; ?>"
            <?php if ($fehler["telefon"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
          </td>
        </tr>

    		<tr>
    			<td class="label"><label>E-Mail: <span class="pflichtfeld">*</span></label></td>
    			<td class="field">
            <?php if ($fehler["email"] != "") { echo $fehler["email"]; } ?>
            <input type="text" name="email" maxlength="<?php echo $zeichenlaenge_email; ?>" value="<?php echo $email; ?>"
            <?php if ($fehler["email"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
    		</tr>

        <tr>
          <td class="label"><label>Firma: </label></td>
          <td class="field">
            <input type="text" name="firma"
            maxlength="<?php echo $zeichenlaenge_firma; ?>" value="<?php echo $firma; ?>"  /></td>
        </tr>
      </table>
    </fieldset>

    <fieldset class="anfrage">
      <legend>Anfrage</legend>
      <table>
      	<tr>
      		<td class="label"><label>Betreff: <span class="pflichtfeld">*</span></label></td>
      		<td>
            <select name="betreff">
              <?php if ($fehler["betreff"] != "") { echo 'class="errordesignfields"'; } ?>/>
              <option selected="selected" value="0"></option>
              <option value="Newsletter"<?php if($betreff=="Newsletter"){ echo "selected";}?>>Newsletter</option>
              <option value="Infomaterial"<?php if($betreff=="Infomaterial"){ echo "selected";}?>>Infomaterial</option>
              <option value="Angebotsanfrage"<?php if($betreff=="Angebotsanfrage"){ echo "selected";}?>>Angebotsanfrage</option>

              <?php if ($fehler["betreff"] != "") { echo 'class="errordesignfields"'; } ?>/>
            </select>
          </td>
        </tr>

      	<tr>
       		<td class="label"><label>Nachricht: <span class="pflichtfeld">*</span></label></td>
       		<td class="field"><?php if ($fehler["nachricht"] != "") { echo $fehler["nachricht"]; } ?><textarea name="nachricht" cols="30" rows="6" <?php if ($fehler["nachricht"] != "") { echo 'class="errordesignfields"'; } ?>><?php echo $_POST[nachricht]; ?></textarea></td>
      	</tr>
      </table>
    </fieldset>

    <?php
      for ($i=0; $i < $cfg['NUM_ATTACHMENT_FIELDS']; $i++) {
        echo '<fieldset class="upload">';
        echo '<legend>Dateianhang</legend>';
        echo '<label>Datei</label><input type="file" size="12" name="f[]" /><br />';
        echo '</fieldset>';
      }
    ?>

    <fieldset class="buttons">
      <legend>Ihre Aktion</legend>
        <div>Hinweis: Felder mit <span class="pflichtfeld"><strong>*</strong></span> m&uuml;ssen ausgef&uuml;llt werden.<br><br> Achten sie bitte auf korrekte Eingabe der Werte.
        <br>
        <input type="submit" name="kf-km" value="Senden" />
        <input type="submit" name="delete" value="L&ouml;schen" />
      </div>
    </fieldset>
  </form>
</div>
