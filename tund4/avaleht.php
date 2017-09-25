<?php
	//muutujad
	$myName = "Tauri";
	$myFamilyName = "Taevik";
	$monthNamesEt =["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//var_dump($monthNamesET);
	
	//echo $monthNamesEt[3]; // masiiv algab nullist
	$monthNow = $monthNamesEt[date("n") - 1];
	
	$hourNow = date("H");
	

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
		
		echo date("d.") .$monthNow . date(" Y") . ", käes on " .$partOfDay;
		echo ".</p>";
		echo "<p> Lehe avamise hetkel oli kell " .date("H:i:s") .".</p>";
		
	?>
	
	
	<h2> Mõned lingid</h2>
	<p> õpime <a href="http://www.tlu.ee">Tallinna ülikoolis.</a> </p>
	
	<p> Minu esimene php leht on <a href="../esimene.php">siin</a>
	<p> Minu sõbra Taneli leht on <a href="../../../~kukltane/veebiprogrammeerimine/">siin</a>
</body>
</html>