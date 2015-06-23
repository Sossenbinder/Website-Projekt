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
    $ortplz         = $_POST["ortplz"];
    $telefon        = $_POST["telefon"];
    $email          = $_POST["email"];
    $betreff        = $_POST["betreff"];
    $nachricht      = $_POST["nachricht"];
    $date           = date("d.m.Y | H:i");
    $ip             = $_SERVER['REMOTE_ADDR'];
    $UserAgent      = $_SERVER["HTTP_USER_AGENT"];
    $host           = getHostByAddr($remote);
    $anrede         = stripslashes($anrede);
    $vorname        = stripslashes($vorname);
    $name           = stripslashes($name);
    $email          = stripslashes($email);
    $betreff        = stripslashes($betreff);
    $nachricht      = stripslashes($nachricht);
  

    if (isset($anrede) && $anrede == "0") {
      $fehler['anrede']   = "<font color=#cc3333>Bitte w&auml;hlen Sie eine 
                      <strong>Anrede</strong> aus.<br /></font>";
    }

    if(!$vorname) {
      $fehler['vorname']  = "<font color=#cc3333>Geben Sie bitte Ihren 
                      <strong>Vornamen</strong> ein.<br /></font>";
    }

    if(!$name) {
      $fehler['name']     = "<font color=#cc3333>Geben Sie bitte Ihren 
                      <strong>Nachnamen</strong> ein.<br /></font>";
    }

    if(!$adresse) {
      $fehler['adresse']  = "<font color=#cc3333>Geben Sie bitte Ihre 
                      <strong>Adresse</strong> ein.<br /></font>";
    }

    if(!$ortplz) {
      $fehler['ortplz']   = "<font color=#cc3333>Geben Sie bitte den 
                      <strong>PLZ</strong> und den <strong>Ort</strong> ein.<br /></font>";
    }

    if (!preg_match("/^[0-9a-zA-ZÄÜÖ_.-]+@[0-9a-z.-]+\.[a-z]{2,6}$/", $email)) {
      $fehler['email']    = "<font color=#cc3333>Geben Sie bitte Ihre 
                      <strong>E-Mail-Adresse</strong> ein.\n<br /></font>";
    }

    if(!$betreff) {
     $fehler['betreff']    = "<font color=#cc3333>Bitte waehlen Sie einen 
                      <strong>Betreff</strong>.<br /></font>";
    }

    if(!$nachricht) {
     $fehler['nachricht']  = "<font color=#cc3333>Geben Sie bitte eine 
                      <strong>Nachricht</strong> ein.<br /></font>";
    }

    if(!$telefon){
      $fehler['telefon']   = "<font color=#cc3333>Geben Sie bitte eine 
      <strong>Telefonnummer</strong> ein.<br /></font>";
    }

    if ($anrede && $vorname && $name && $adresse && $ortplz && $telefon && $email && $betreff && $nachricht){
      $mail1="piano.lo";
      $mail2="rentz@g";
      $mail3="mail.com";

      $headers = "From: "." <".$email.">";

      $nachricht .= "\n\n\nBitte melden sie sich bei mir: \n".$adresse." ".$ortplz."\nOder auch telefonisch: ".$telefon;
      $nachricht .= "\n\nMit freundlichen Grueßen,\n".$anrede." ".$vorname." ".$name;

      if(mail($mail1.$mail2.$mail3, $betreff, $nachricht, $headers)){
        echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=".$danke."\">";
      };
      exit;
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
              <option value="Herr" <?php if($_POST['anrede']=="Herr"){ echo "selected";}?>>Herr</option>
              <option value="Frau" <?php if($_POST['anrede']=="Frau"){ echo "selected";}?>>Frau</option>
            </select>
          </td>
        </tr>

		    <tr>
		      <td class="label"><label>Vorname: <span class="pflichtfeld">*</span></label></td>
          <td class="field"><?php if ($fehler["vorname"] != "") { echo $fehler["vorname"];} ?>
            <input type="text" name="vorname" maxlength="<?php echo $zeichenlaenge_vorname; ?>" value="<?php echo $_POST[vorname]; ?>"
            <?php if($fehler["vorname"] != "") {echo 'class="errordesignfields"';} ?>/>
          </td>
		    </tr>

		    <tr>
          <td class="label"><label>Nachname: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if($fehler["name"] != "") { echo $fehler["name"];} ?>
            <input type="text" name="name" maxlength="<?php echo $zeichenlaenge_name; ?>" id="textfield" value="<?php echo $_POST[name]; ?>"
            <?php if ($fehler["name"] != "") { echo 'class="errordesignfields"'; } ?>/>
          </td>
		    </tr>

        <tr>
          <td class="label"><label>Adresse: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["adresse"] != "") { echo $fehler["adresse"]; } ?>
            <input type="text" name="adresse" maxlength="<?php echo $zeichenlaenge_email; ?>" value="<?php echo $_POST[adresse]; ?>"
            <?php if ($fehler["adresse"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
        </tr>

        <tr>
          <td class="label"><label>PLZ / Ort: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["ortplz"] != "") { echo $fehler["ortplz"]; } ?>
            <input type="text" name="ortplz" maxlength="<?php echo $zeichenlaenge_ortplz; ?>" value="<?php echo $_POST[ortplz]; ?>"
            <?php if ($fehler["ortplz"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
        </tr>

        <tr>
          <td class="label"><label>Telefon: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
             <?php if ($fehler["telefon"] != "") { echo $fehler["telefon"]; } ?>
            <input type="text" name="telefon" maxlength="<?php echo $zeichenlaenge_telefon; ?>" value="<?php echo $_POST[telefon]; ?>"
            <?php if ($fehler["telefon"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
          </td>
        </tr>

    		<tr>
    			<td class="label"><label>E-Mail: <span class="pflichtfeld">*</span></label></td>
    			<td class="field">
            <?php if ($fehler["email"] != "") { echo $fehler["email"]; } ?>
            <input type="text" name="email" maxlength="<?php echo $zeichenlaenge_email; ?>" value="<?php echo $_POST[email]; ?>"
            <?php if ($fehler["email"] != "") { echo 'class="errordesignfields"'; } ?>/></td>
    		</tr>

        <tr>
          <td class="label"><label>Fax: </label></td>
          <td class="field">
            <input type="text" name="fax" maxlength="<?php echo $zeichenlaenge_fax; ?>" value="<?php echo $_POST[fax]; ?>"  />
          </td>
        </tr>

        <tr>
          <td class="label"><label>Firma: </label></td>
          <td class="field">
            <input type="text" name="firma"
            maxlength="<?php echo $zeichenlaenge_firma; ?>" value="<?php echo $_POST[firma]; ?>"  /></td>
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
              <option value="Newsletter"<?php if($_POST['betreff']=="Newsletter"){ echo "selected";}?>>Newsletter</option>
              <option value="Infomaterial"<?php if($_POST['betreff']=="Infomaterial"){ echo "selected";}?>>Infomaterial</option>
              <option value="Angebotsanfrage"<?php if($_POST['betreff']=="Angebotsanfrage" || $_GET['betreff']=="Angebotsanfrage"){ echo "selected";}?>>Angebotsanfrage</option>

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
        <div>Hinweis: Felder mit <span class="pflichtfeld"><strong>*</strong></span> m&uuml;ssen ausgef&uuml;llt werden.
        <br>
        <input type="submit" name="kf-km" value="Senden" />
        <input type="submit" name="delete" value="L&ouml;schen" />
      </div>
    </fieldset>
  </form>
</div>
