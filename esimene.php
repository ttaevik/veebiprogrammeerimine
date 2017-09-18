<?php
	//muutujad
	$myName = "Tauri";
	$myFamilyName = "Taevik";
	$monthNamesEt =["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//var_dump($monthNamesET);
	
	//echo $monthNamesEt[3]; // masiiv algab nullist
	$monthNow = $monthNamesEt[date("n" -1)];
	
	$hourNow = date("H");
	
	$schoolDaystart = date("d.m.Y") ." " ."8:15";
	//echo $schoolDaystart;
	$schoolBegin = strtotime($schoolDaystart);
	//echo $schoolBegin;
	$timeNow = strtotime("now");
	//echo ($timeNow - $schoolBegin);
	
	//$minutesPassed = round(($timeNow- $schoolBegin) / 60);   <- arvutab minutid
	//echo $minutesPassed;
	
	//echo $hourNow;
	//võrdlen kellaaega ja annan hinnangu, mis päeva osaga on tegemist (<  >  ==  >=  <=  !=)  
	$partOfDay = " ";
	if ( $hourNow < 8 ){
		$partOfDay = "varajane hommik";
	}
	//echo $partOfDay;
	if ( $hourNow >= 8 and $hourNow < 16 ) {
		$partOfDay = "koolipäev";
	}
	if ( $hourNow >= 16 ){
		$partOfDay = "vaba aeg";
	}
	
	//vanusega seotud muutujad
	$myAge = 0;
	$ageNote = "";
	$myBirthYear;
	$yearsOfMyLife= "";
	
	
	//echo $_POST;
	//var_dump($_POST);
	//echo $_POST["birthYear"];
	
	//arvutame vanuse:
	if(isset($_POST["birthYear"]) and $_POST ["birthYear"] != 0 ){ 
		$myBirthYear = $_POST ["birthYear"];
		$myAge = date("Y") - $myBirthYear;
		//echo $myAge;
		$ageNote= "<p> Te olete umbes " .$myAge ." aastat vana.</p>";
	
	$yearsOfMyLife = "<ol> \n"; //  \n = teksti sees reavahetus
	$yearNow = date("Y"); // päringu lihtsustamiseks teeme uue muutuja
	for($i = $myBirthYear; $i <= $yearNow; $i ++){
		$yearsOfMyLife .="<li>" .$i ."</li> \n";
	}
	$yearsOfMyLife .= "</ol> \n";
	
	}
	

	//lihtne tsükkel
		// mingit tegevust saab teha 5 korda
	/*for ( $i = 0; $i < 5; $i ++){
	
	echo "ha";
	}*/
	
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
		echo date("d.") .$monthNow . date(" Y") . ", käes on " .$partOfDay;
		echo ".</p>";
		echo "<p> Lehe avamise hetkel oli kell " .date("H:i:s") .".</p>";
		
	?>
	<h2> Räägime vanusest </h2>
	<p> sisesta oma sünniaasta, arvutame vanuse!</p>
	<form method="POST">
		<label> Teie sünniaasta: </label>
		<input name="birthYear" id="birthYear" type= "number" max="2017" min="1900" value="<?php echo $myBirthYear; ?>">
		
		<input id="submitBirthYear" type="submit" value="Kinnita andmed">
	
	
	</form>
	<?php
		if ($ageNote != "")
			//!= <- EI OLE "" <- tühjus
			echo $ageNote;
		
		if ($yearsOfMyLife != "") {
			echo "\n <h3> Olete elanud järgmisetel aastatel </h3> \n" . $yearsOfMyLife;
		}
	?>
</body>
</html>