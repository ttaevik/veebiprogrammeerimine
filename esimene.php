<?php
	//muutujad
	$myName = "Tauri";
	$myFamilyName = "Taevik";
	
	$hourNow = date("H");
	
	$schoolDaystart = date("d.m.Y") ." " ."8:15";
	//echo $schoolDaystart;
	$schoolBegin = strtotime($schoolDaystart);
	//echo $schoolBegin;
	$timeNow = strtotime("now");
	//echo ($timeNow - $schoolBegin);
	
	$minutesPassed = round($timenow - $schoolBegin) / 60);
	echo $minutesPassed;
	
	//echo $hourNow;
	//võrdlen kellaaega ja annan hinnangu, mis päeva osaga on tegemist (<  >  ==  >=  <=  !=)  
	$partOfDay = " ";
	if ( hourNow < 8 ){
		$partOfDay = "varajane hommik";
	}
	//echo $partOfDay;
	if ( $hourNow >= 8 and $hourNow < 16 ) {
		$partOfDay = "koolipäev";
	}
	if ( hourNow >= 16 ){
		$partOfDay = "vaba aeg";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Tauri Taevik veebiprogremise asjad
	</title>
</head>
<body>
	
	<h1>
	<?php
	echo $myName ." " .$myFamilyName;
	?>
	</h1>
	<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
	<p>Minu nimi on Tauri Taevik, olen Tallinna Ülikooli õpilane ning õpin informaatikat</p>
	<?php
		echo "<p>kõige esimene PHP abil väljastatud sõnum.</p>";
		echo "<p> Täna on ";
		echo date("d.m.Y") . ", käes on " .$partOfDay;
		echo ".</p>";
		echo "<p> Lehe avamise hetkel oli kell " .date("H:i:s") .".</p>";
		
	?>
</body>


</html>