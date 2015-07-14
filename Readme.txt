Eine Anleitung um diese Webseite zu nutzen:

	Das Projekt wurde bei uns über XAMPP entwickelt und präsentiert. Demnach können wir leider kein Live-System anbieten. 
	Im folgenden werde ich die nötigen Schritte erläutern, um diese Webseite korrekt konfiguriert testen zu können.
	
	1.) Zuerst müssen die SQL-Datenbanken eingebunden werden unter localhost/phpmyadmin.
		
		Für die Newsletterdatenbank (subscriptiondetails) haben wir folgende Berechtigungen genutzt:
		
		  $servername = 'localhost';
		  $username = 'root';
		  $password = 'lorentz1234';
		  $dbname = 'newsletterdata';
		  
		  In der Datenbank "newsletterdata" wird also die Datenbank "subscriptiondetails" abgespeichert.
		  
		Für die GeoInfo-Datenbank:
		
		  $servername = 'localhost';
		  $username = 'root';
		  $password = 'lorentz1234';
		  $dbname = 'postcodes';
		  
		  In der Datenbank "postcodes" wird also die Datenbank "geoinfo" abgespeichert.
	
		  Für mögliche Probleme durch Änderung des Passwortes / des Nutzernamen können wir keine Haftung übernehmen.
	
	2.) Der gesamte Ordner wird in XAMPP/htdocs abgespeichert, und die Seite über den PHP-Ordner geöffnet. Dieser enthält eine index.php,
		die beim Öffnen des Ordners automatisch aufgerufen werden sollte.
		
	3.) Da Mails über XAMPP relativ problematisch sind, haben wir uns mit einem Tool Abhilfe geschaffen. Das sogenannte "Test Mail Server Tool"
		(http://www.toolheap.com/test-mail-server-tool/ )"hört" auf einen Port und simuliert so mögliche mail()-Aufrufe im PHP Skript. Sobald
		ein solcher Befehl ausgeführt wurde, generiert das Tool eine Email, die exakt so aussieht wie jene, die normalerweise verschickt 
		worden wäre. Diese kann ganz normal betrachtet werden, und auch für die Verifizierung genutzt werden, ohne dass die Email wirklich 
		verschickt wurde.
		
Nachdem diese Schritte befolgt wurden, sollte es kein Problem mehr geben. Falls doch noch Fragen aufkommen, stehen wir ihnen gerne zur Verfügung.