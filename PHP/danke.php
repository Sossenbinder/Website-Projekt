<!DOCTYPE html >

	<head>
		<link rel="stylesheet" type="text/css" href="../CSS/general.css">
	    <link rel="stylesheet" type="text/css" href="../CSS/kontakte.css">
	</head>

	<body id="Kontaktformularseite">
		<div class="kontaktformular">
			<fieldset class="kontaktdaten">
		    	<legend>Versandbest&auml;tigung</legend>
					<table>
						<tr>
							<td><p>Vielen Dank. Ihre Nachricht wurde erfolgreich &uuml;bermittelt.</p></td>
						</tr>
					</table>
		  		</fieldset><p>
					<button class="buttonDanke" style="color: black"onClick="back()">Zur&uuml;ck</button>
		 </div>

		<script>
			function back(){
				history.back();
				console.log("Test");
			}
		</script>
	</body>
