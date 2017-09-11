<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Tauri Taevik veebiprogremise asjad
	</title>
</head>
<body>
	<h1> Tauri Taevik</h1>
	<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
	<p>Minu nimi on Tauri Taevik, olen Tallinna Ülikooli õpilane ning õpin informaatikat</p>
	<?php
		echo "<p>kõige esimene PHP abil väljastatud sõnum.</p>";
		echo "<p> Täna on ";
		echo date("d.m.Y");
		echo ".</p>";
		echo "<p> Lehe avamise hetkel oli kell " .date("H:i:s") .".</p>";
		
	?>
</body>


</html>