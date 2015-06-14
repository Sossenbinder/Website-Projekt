<div class="siteContent">

<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
date_default_timezone_set('Europe/Berlin');
header('Content-type: text/html; charset=utf-8');

$script_root = substr(__FILE__, 0,
                        strrpos(__FILE__,
                                DIRECTORY_SEPARATOR)
                       ).DIRECTORY_SEPARATOR;

require_once $script_root.'upload.php';

$remote = getenv("REMOTE_ADDR");

function encrypt($string, $key) {
$result = '';
for($i=0; $i<strlen($string); $i++) {
   $char = substr($string, $i, 1);
   $keychar = substr($key, ($i % strlen($key))-1, 1);
   $char = chr(ord($char)+ord($keychar));
   $result.=$char;
}
return base64_encode($result);
}
$sicherheits_eingabe = encrypt($_POST["sicherheitscode"], "8h384ls94");
$sicherheits_eingabe = str_replace("=", "", $sicherheits_eingabe);

@require('config.php');

if ($_POST['delete'])
{
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
  $fehler['anrede'] = "<font color=#cc3333>Bitte w&auml;hlen Sie eine <strong>Anrede</strong> aus.<br /></font>";
}

if(!$vorname) {
  $fehler['vorname'] = "<font color=#cc3333>Geben Sie bitte Ihren <strong>Vornamen</strong> ein.<br /></font>";
}

if(!$name) {
  $fehler['name'] = "<font color=#cc3333>Geben Sie bitte Ihren <strong>Nachnamen</strong> ein.<br /></font>";
}

if(!$adresse) {
  $fehler['adresse'] = "<font color=#cc3333>Geben Sie bitte Ihre <strong>Adresse</strong> ein.<br /></font>";
}

if(!$ortplz) {
  $fehler['ortplz'] = "<font color=#cc3333>Geben Sie bitte den <strong>PLZ</strong> und den <strong>Ort</strong> ein.<br /></font>";
}

if (!preg_match("/^[0-9a-zA-ZÄÜÖ_.-]+@[0-9a-z.-]+\.[a-z]{2,6}$/", $email)) {
   $fehler['email'] = "<font color=#cc3333>Geben Sie bitte Ihre <strong>E-Mail-Adresse</strong> ein.\n<br /></font>";
}

if(!$betreff) {
 $fehler['betreff'] = '<font color=#cc3333>Bitte waehlen Sie einen <strong>Betreff</strong>.<br /></font>';
}

if(!$nachricht) {
 $fehler['nachricht'] = '<font color=#cc3333>Geben Sie bitte eine <strong>Nachricht</strong> ein.<br /></font>';
}

if (!isset($fehler) || count($fehler) == 0) {
  $error             = false;
  $errorMessage      = '';
  $uploadErrors      = array();
  $uploadedFiles     = array();
  $totalUploadSize   = 0;

  if ($cfg['UPLOAD_ACTIVE'] && in_array($_SERVER['REMOTE_ADDR'], $cfg['BLACKLIST_IP']) === true) {
    $error = true;
    $fehler['upload'] = '<font color=#990000>Sie haben keine Erlaubnis Dateien hochzuladen.<br /></font>';
  }

  if (!$error) {
    for ($i=0; $i < $cfg['NUM_ATTACHMENT_FIELDS']; $i++) {
      if ($_FILES['f']['error'][$i] == UPLOAD_ERR_NO_FILE) {
        continue;
      }
      $extension = explode('.', $_FILES['f']['name'][$i]);
      $extension = strtolower($extension[count($extension)-1]);
      $totalUploadSize += $_FILES['f']['size'][$i];

     if ($_FILES['f']['error'][$i] != UPLOAD_ERR_OK) {
                  $uploadErrors[$j]['name'] = $_FILES['f']['name'][$i];
                  switch ($_FILES['f']['error'][$i]) {
                      case UPLOAD_ERR_INI_SIZE :
                          $uploadErrors[$j]['error'] = 'Die Datei ist zu groß (PHP-Ini Direktive).';
                      break;
                      case UPLOAD_ERR_FORM_SIZE :
                          $uploadErrors[$j]['error'] = 'Die Datei ist zu groß (MAX_FILE_SIZE in HTML-Formular).';
                      break;
                      case UPLOAD_ERR_PARTIAL :
              if ($cfg['UPLOAD_ACTIVE']) {
                              $uploadErrors[$j]['error'] = 'Die Datei wurde nur teilweise hochgeladen.';
              } else {
                $uploadErrors[$j]['error'] = 'Die Datei wurde nur teilweise versendet.';
                }
                      break;
                      case UPLOAD_ERR_NO_TMP_DIR :
                          $uploadErrors[$j]['error'] = 'Es wurde kein temporärer Ordner gefunden.';
                      break;
                      case UPLOAD_ERR_CANT_WRITE :
                          $uploadErrors[$j]['error'] = 'Fehler beim Speichern der Datei.';
                      break;
                      case UPLOAD_ERR_EXTENSION  :
                          $uploadErrors[$j]['error'] = 'Unbekannter Fehler durch eine Erweiterung.';
                      break;
                      default :
              if ($cfg['UPLOAD_ACTIVE']) {
                              $uploadErrors[$j]['error'] = 'Unbekannter Fehler beim Hochladen.';
              } else {
                $uploadErrors[$j]['error'] = 'Unbekannter Fehler beim Versenden des Email-Attachments.';
              }
                  }

                  $j++;
                  $error = true;
              }
              else if ($totalUploadSize > $cfg['MAX_ATTACHMENT_SIZE']*1024) {
                  $uploadErrors[$j]['name'] = $_FILES['f']['name'][$i];
                  $uploadErrors[$j]['error'] = 'Maximaler Upload erreicht ('.$cfg['MAX_ATTACHMENT_SIZE'].' KB).';
                  $j++;
                  $error = true;
              }
              else if ($_FILES['f']['size'][$i] > $cfg['MAX_FILE_SIZE']*1024) {
                  $uploadErrors[$j]['name'] = $_FILES['f']['name'][$i];
                  $uploadErrors[$j]['error'] = 'Die Datei ist zu groß (max. '.$cfg['MAX_FILE_SIZE'].' KB).';
                  $j++;
                  $error = true;
              }
              else if (!empty($cfg['BLACKLIST_EXT']) && strpos($cfg['BLACKLIST_EXT'], $extension) !== false) {
                  $uploadErrors[$j]['name'] = $_FILES['f']['name'][$i];
                  $uploadErrors[$j]['error'] = 'Die Dateiendung ist nicht erlaubt.';
                  $j++;
                  $error = true;
              }
              else if (preg_match("=^[\\:*?<>|/]+$=", $_FILES['f']['name'][$i])) {
                  $uploadErrors[$j]['name'] = $_FILES['f']['name'][$i];
                  $uploadErrors[$j]['error'] = 'Ungültige Zeichen im Dateinamen (\/:*?<>|).';
                  $j++;
                  $error = true;
              }
              else if ($cfg['UPLOAD_ACTIVE'] && file_exists($cfg['UPLOAD_FOLDER'].'/'.$_FILES['f']['name'][$i])) {
                  $uploadErrors[$j]['name'] = $_FILES['f']['name'][$i];
                  $uploadErrors[$j]['error'] = 'Die Datei existiert bereits.';
                  $j++;
                  $error = true;
              }
              else {
          if ($cfg['UPLOAD_ACTIVE']) {
                     move_uploaded_file($_FILES['f']['tmp_name'][$i], $cfg['UPLOAD_FOLDER'].'/'.$_FILES['f']['name'][$i]);
          }
                  $uploadedFiles[] = $_FILES['f']['name'][$i];
              }
          }
      }

      if ($error) {
          $errorMessage = 'Es sind folgende Fehler beim Versenden des Kontaktformulars aufgetreten:'."\n";
          if (count($uploadErrors) > 0) {
              foreach ($uploadErrors as $err) {
                  $tmp .= '<strong>'.$err['name']."</strong><br/>\n- ".$err['error']."<br/><br/>\n";
              }
              $tmp = "<br/><br/>\n".$tmp;
          }
          $errorMessage .= $tmp.'';
          $fehler['upload'] = $errorMessage;
      }
  }



   if (!isset($fehler))
   {

	$recipient = "".$empfaenger."";
    $betreff = "".$_POST["betreff"]."";
	//$mailheaders = "From: \"".stripslashes($_POST["vorname"])." ".stripslashes($_POST["name"])."\" <".$_POST["email"].">\n";
	//$mailheaders .= "Reply-To: <".$_POST["email"].">\n";
	//$mailheaders .= "X-Mailer: PHP/" . phpversion() . "\n";
	$mailheader_betreff = "=?UTF-8?B?".base64_encode($betreff)."?=";
	$mailheaders   = array();
	$mailheaders[] = "MIME-Version: 1.0";
	$mailheaders[] = "Content-type: text/plain; charset=utf-8";
	$mailheaders[] = "From: =?UTF-8?B?".base64_encode(stripslashes($_POST["vorname"])." ".stripslashes($_POST["name"]))."?= <".$_POST["email"].">";
	$mailheaders[] = "Reply-To: <".$_POST["email"].">";
	$mailheaders[] = "Subject: ".$mailheader_betreff;
	$mailheaders[] = "X-Mailer: PHP/".phpversion();




   $msg  = "Folgendes wurde am ". $date ." Uhr per Formular geschickt:\n" . "-------------------------------------------------------------------------\n\n";
   $msg .= "Name: " . $anrede . " " . $titel . "" . $vorname . " " . $name . "\n";
$msg .= "Firma: " . $firma . "\n\n";
$msg .= "E-Mail: " . $email . "\n";
$msg .= "Telefon: " . $telefon . "\n";
$msg .= "\nBetreff: " . $betreff . "\n";
$msg .= "Nachricht:\n" . $_POST['nachricht'] = preg_replace("/\r\r|\r\n|\n\r|\n\n/","\n",$_POST['nachricht']) . "\n\n";

   "-------------------------------------------------------------------------\n\n";
 if (count($uploadedFiles) > 0) {
	   if ($cfg['UPLOAD_ACTIVE']) {
       	   $msg .= 'Es wurden folgende Dateien hochgeladen:'."\n";
	       foreach ($uploadedFiles as $file) {
	           $msg .= ' - '.$cfg['DOWNLOAD_URL'].'/'.$cfg['UPLOAD_FOLDER'].'/'.$file."\n";
	       }
	   } else {
		   $msg .= 'Es wurden folgende Dateien als Attachment angehängt:'."\n";
		   foreach ($uploadedFiles as $file) {
	           $msg .= ' - '.$file."\n";
	       }
	   }
   }
  $msg .= "\n\nIP Adresse: " . $ip . "\n";
  $msg = strip_tags ($msg);


	//$mailheaders = "From: \"".stripslashes($_POST["vorname"])." ".stripslashes($_POST["name"])."\" <".$_POST["email"].">\n";
	//$mailheaders .= "Reply-To: <".$_POST["email"].">\n";
	//$mailheaders .= "X-Mailer: PHP/" . phpversion() . "\n";
	$mailheader_betreff = "=?UTF-8?B?".base64_encode($betreff)."?=";
	$mailheaders   = array();


	if (!$cfg['UPLOAD_ACTIVE'] && count($uploadedFiles) > 0) {
		$attachments = array();
		for ($i = 0; $i < $cfg['NUM_ATTACHMENT_FIELDS']; $i++) {
		   	if ($_FILES['f']['name'][$i] == UPLOAD_ERR_NO_FILE) {
				continue;
			}
			$attachments[] = $_FILES['f']['tmp_name'][$i];
		}
		$boundary = md5(uniqid(rand(), true));


		// allgemeiner Header
		$mailheaders[] = "MIME-Version: 1.0";
		$mailheaders[] = "Content-type: multipart/mixed; boundary=\"".$boundary."\"";
		$mailheaders[] = "From: =?UTF-8?B?".base64_encode(stripslashes($_POST["vorname"])." ".stripslashes($_POST["name"]))."?= <".$_POST["email"].">";
		$mailheaders[] = "Reply-To: <".$_POST["email"].">";
		$mailheaders[] = "Subject: ".$mailheader_betreff;
		$mailheaders[] = "X-Mailer: PHP/".phpversion();

		// Nachricht
		$mailheaders[] = "--".$boundary;
		$mailheaders[] = "Content-type: text/plain; charset=utf-8";
		$mailheaders[] = "Content-Transfer-Encoding: 8bit";
		$mailheaders[] = "Folgendes wurde am ". $date ." Uhr per Formular geschickt:\n";
		$mailheaders[] = $msg;
		$mailheaders[] = "";

		// Anhänge
		for ($i = 0; $i < count($uploadedFiles); $i++) {
			$file = fopen($attachments[$i],"r");
			$content = fread($file,filesize($attachments[$i]));
			fclose($file);
			$encodedfile = chunk_split(base64_encode($content));
			$mailheaders[] = "--".$boundary;
			$mailheaders[] = "Content-Disposition: attachment; filename=\"".$uploadedFiles[$i]."\"";
			$mailheaders[] = "Content-Type: application/octet-stream; name=\"".$uploadedFiles[$i]."\"";
			$mailheaders[] = "Content-Transfer-Encoding: base64";
			$mailheaders[] = "";
			$mailheaders[] = $encodedfile;
		}
		$mailheaders[] = "--".$boundary."--";
	}
	else{
		$mailheaders[] = "MIME-Version: 1.0";
		$mailheaders[] = "Content-type: text/plain; charset=utf-8";
		$mailheaders[] = "From: =?UTF-8?B?".base64_encode(stripslashes($_POST["vorname"])." ".stripslashes($_POST["name"]))."?= <".$_POST["email"].">";
		$mailheaders[] = "Reply-To: <".$_POST["email"].">";
		$mailheaders[] = "Subject: ".$mailheader_betreff;
		$mailheaders[] = "X-Mailer: PHP/".phpversion();
	}




	$dsubject = "Ihre Anfrage";
	//$dmailheaders = "From: ".$ihrname." <".$recipient.">\n";
	//$dmailheaders .= "Reply-To: <".$recipient.">\n";
	$dmailheader_dsubject = "=?UTF-8?B?".base64_encode($dsubject)."?=";
   	$dmailheaders   = array();
	$dmailheaders[] = "MIME-Version: 1.0";
	$dmailheaders[] = "Content-type: text/plain; charset=utf-8";
	$dmailheaders[] = "From: =?UTF-8?B?".base64_encode($ihrname)."?= <".$recipient.">";
	$dmailheaders[] = "Reply-To: <".$recipient.">";
	$dmailheaders[] = "Subject: ".$dmailheader_dsubject;
	$dmailheaders[] = "X-Mailer: PHP/".phpversion();

   $dmsg  = "Vielen Dank für Ihre E-Mail. Wir werden schnellstmöglich darauf antworten.\n\n";
   $dmsg .= "Zusammenfassung: \n" .
  "-------------------------------------------------------------------------\n\n";
   $dmsg .= "Name: " . $anrede . " " . $titel . "" . $vorname . " " . $name . "\n";
$dmsg .= "Firma: " . $firma . "\n\n";
$dmsg .= "E-Mail: " . $email . "\n";
$dmsg .= "Telefon: " . $telefon . "\n";
$dmsg .= "\nBetreff: " . $betreff . "\n";
$dmsg .= "Nachricht:\n" . str_replace("\r", "", $nachricht) . "\n\n";

   if (count($uploadedFiles) > 0) {
       $dmsg .= 'Sie haben folgende Dateien übertragen:'."\n";
       foreach ($uploadedFiles as $file) {
           $dmsg .= ' - '.$file."\n";
       }
   }
   $dmsg = strip_tags ($dmsg);


//if (mail($recipient,$betreff,$msg,$mailheaders)) {
//mail($email, $dsubject, $dmsg, $dmailheaders);
if (mail($recipient, $mailheader_betreff, $msg, implode("\n", $mailheaders))) {
mail($email, $dmailheader_dsubject, $dmsg, implode("\n", $dmailheaders));


echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=".$danke."\">";
exit;

}
}
}

?>




<div class="kontaktformular">
  <link rel="stylesheet" type="text/css" href="../CSS/general.css">
  <link rel="stylesheet" type="text/css" href="../CSS/kontakte.css">

  <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <p></p>

    <fieldset class="kontaktdaten">
      <legend>Kontaktdaten</legend>
      <table>
		    <tr>
          <td class="label"><label>Anrede: <span class="pflichtfeld">*</span></label></td>
          <td class="field">
            <?php if ($fehler["anrede"] != "") { echo $fehler["anrede"]; } ?>
            <select style="width: 100px;" name="anrede" <?php if ($fehler["anrede"] != "") { echo 'class="errordesignfields"'; } ?>>
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
    <p></p>

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
       		<td class="field"><?php if ($fehler["nachricht"] != "") { echo $fehler["nachricht"]; } ?><textarea name="nachricht" style="width:200px;border-right: 1px solid #ddd;border-bottom: 1px solid #ddd;border-left: 1px solid #666666;border-top: 1px solid #666666;padding: 0px 3px;margin: 3px 0;"  cols="30" rows="8" <?php if ($fehler["nachricht"] != "") { echo 'class="errordesignfields"'; } ?>><?php echo $_POST[nachricht]; ?></textarea></td>
      	</tr>
      </table>
    </fieldset>
    <p> </p>
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
      <br />
      <div>Hinweis: Felder mit <span class="pflichtfeld"><strong>*</strong></span> m&uuml;ssen ausgef&uuml;llt werden.<br /><br />
        <input type="submit" name="kf-km" value="Senden" onclick="tescht();"/>
        <input type="submit" name="delete" value="L&ouml;schen" />
      </div>
    </fieldset>
  </form>
</div>
