<?php
$cfg = array();

#########################################################################
#	Kontaktformular.com         					                                #
#	http://www.kontaktformular.com        						                    #
#	All rights by KnotheMedia.de                                    			#
#-----------------------------------------------------------------------#
#	I-Net: http://www.knothemedia.de                            					#
#########################################################################
// Der Copyrighthinweis darf NICHT entfernt werden!

  

  // true = Anhänge werden in ein Verzeichnis hochgeladen
  // false = Anhänge werden als Email-Attachment versendet (standard)
  $cfg['UPLOAD_ACTIVE'] = false;

  //--------------------------------------------------------------------------------------//
  //--------------------------------------------------------------------------------------//
  //--------------------------------------------------------------------------------------//


  // Maximale Größe von einer Datei in KB.
  // Diese Option ist abhängig von den PHP und Server Einstellungen.
  $cfg['MAX_FILE_SIZE'] = 1024;

  // Maximale Größe von mehrerer Dateien in KB. (bei mehr als 1 Uploadfeld)
  $cfg['MAX_ATTACHMENT_SIZE'] = 2048;

  // Anzahl der Attachmentfelder
  $cfg['NUM_ATTACHMENT_FIELDS'] = 0;

  // Verbotene Dateiendungen
  // Beispiel: exe|com|pif
  $cfg['BLACKLIST_EXT'] = 'exe|pif|gif|php|htm|html|com|bat';

  // Gesperrte IPs
  // Beispiel: array('192.168.1.2', '192.168.2.4');
  $cfg['BLACKLIST_IP'] = array();
  
  //--------------------------------------------------------------------------------------//
  //--------------------------------------------------------------------------------------//
  //--------------------------------------------------------------------------------------//
  
  // Falls, die Anhänge in ein Verzeichnis hochgeladen werden sollen, bitte diese Angaben vervollständigen !!!

  // Der Ordner "upload" muss erstellt werden. Dieser benötigt Schreibrechte. (chmod 777)
  $cfg['UPLOAD_FOLDER'] = 'upload';

  // Pfad zum Formular (ohne / am Ende!!)
  $cfg['DOWNLOAD_URL'] = 'http://www.ihre-internetseite.de/kontaktformular';

?>