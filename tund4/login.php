<?php
	require("../../config.php");
	//echo $serverHost;
	
	$signupFirstName = "";
	$signupFamilyName = "";
	$signupEmail = "";
	$gender = "";
	$signupBirthDay = null;
	$signupBirthMonth = null;
	$signupBirthYear = null;
	$signupBirthDate = null;
	$loginEmail = "";
	
	$signupFirstNameError = "";
	$signupFamilyNameError = "";
	$signupBirthDayError = "";
	$signupGenderError = "";
	$signupEmailError = "";
	$signupPasswordError = "";
	
	//kas on kasutajanimi sisestatud
	if (isset($_POST["loginEmail"])){
		if (empty ($_POST["loginEmail"])){
			//$loginEmailError ="NB! Ilma selleta ei saa sisse logida!";
		} else {
			$loginEmail = $_POST["loginEmail"];
		}
	}
	
	//kontrollime, kas kirjutati eesnimi
	if (isset($_POST["signupFirstName"])){
		if (empty($_POST["signupFirstName"])){
			$signupFirstNameError ="NB! V�li on kohustuslik!";
		} else {
			$signupFirstName = $_POST["signupFirstName"];
		}
	}
	
	//kontrollime, kas kirjutati perekonnanimi
	if (isset($_POST["signupFamilyName"])){
		if (empty ($_POST["signupFamilyName"])){
			$signupFamilyNameError ="NB! V�li on kohustuslik!";
		} else {
			$signupFamilyName = $_POST["signupFamilyName"];
		}
	}
	
	if (isset ($_POST["signupBirthDay"])){
		$signupBirthDay = $_POST["signupBirthDay"];
	}
	
	//kas s�nnikuu on valitud
	if( isset($_POST["signupBirthMonth"])){
		$signupBirthMonth = intval($_POST["signupBirthMonth"]);
	}
	
	if (isset ($_POST["signupBirthYear"])){
		$signupBirthYear = $_POST["signupBirthYear"];
	}
	
	if (isset ($_POST["signupBirthDay"]) and isset($_POST["signupBirthMonth"]) and isset ($_POST["signupBirthYear"])){
		//kontrollin kuup�eva valiidsust
		if(checkdate(intval($_POST["signupBirthMonth"]), intval($_POST["signupBirthDay"]), intval($_POST["signupBirthYear"]))){
			$birthDate = date_create(intval($_POST["signupBirthMonth"]) ."/" .intval($_POST["signupBirthDay"]) ."/" .intval($_POST["signupBirthYear"]));
			$signupBirthDate = date_format($birthDate, "Y-m-d");
			//echo $signupBirthDay;
		} else {
			$signupBirthDayError .= "Kuup�ev ei vasta n�uetele!";
		}
	}
	
	//kontrollime, kas kirjutati kasutajanimeks email
	if (isset ($_POST["signupEmail"])){
		if (empty ($_POST["signupEmail"])){
			//$signupEmailError ="NB! V�li on kohustuslik!";
		} else {
			$signupEmail = $_POST["signupEmail"];
		}
	}
	
	if (isset ($_POST["signupPassword"])){
		if (empty ($_POST["signupPassword"])){
			//$signupPasswordError = "NB! V�li on kohustuslik!";
		} else {
			//polnud t�hi
			if (strlen($_POST["signupPassword"]) < 8){
				//$signupPasswordError = "NB! Liiga l�hike salas�na, vaja v�hemalt 8 t�hem�rki!";
			}
		}
	}
	
	if (isset($_POST["gender"]) && !empty($_POST["gender"])){ //kui on m��ratud ja pole t�hi
			$gender = intval($_POST["gender"]);
		} else {
			//$signupGenderError = " (Palun vali sobiv!) M��ramata!";
	}
	
	//KIRJUTAN UUE KASUTAJA ANDMEBAASI
	if(empty($signupFirstNameError) and empty($signupFamilyNameError) and empty($signupFamilyNameError) and empty ($signupBirthDayError) and empty($signupGenderError) and empty($signupEmailError) and empty($signupPasswordError)){
		echo "Hakkan salvestama! \n";
		$signupPassword = hash("sha512", $_POST["signupPassword"]);
		
		//loon �henduse serveriga
		$database = "if17_ttaevik_2";
		$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		// k�sk andmebaasile
		$stmt = $mysqli ->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli-> error;
		//s - string, tekst
		//i - integar, t�isarv
		//d- decimal,ujukoma
		$stmt->bind_param("sssiss",$signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//stmt->execute ();
		if($stmt->execute()){
			echo "�nnestus!";
		}	else {
			echo "tekkis viga: " .$stmt-> error;
		}
	}
	//Tekitame kuup�eva valiku
	$signupDaySelectHTML = "";
	$signupDaySelectHTML .= '<select name="signupBirthDay">' ."\n";
	$signupDaySelectHTML .= '<option value="" selected disabled>p�ev</option>' ."\n";
	for ($i = 1; $i < 32; $i ++){
		if($i == $signupBirthDay){
			$signupDaySelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupDaySelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ." \n";
		}
		
	}
	$signupDaySelectHTML.= "</select> \n";
	
	//Tekitame s�nnikuu valiku
	$monthNamesEt = ["jaanuar", "veebruar", "m�rts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	$signupMonthSelectHTML = "";
	$signupMonthSelectHTML .= '<select name="signupBirthMonth">' ."\n";
	$signupMonthSelectHTML .= '<option value="" selected disabled>kuu</option>' ."\n";
	foreach ($monthNamesEt as $key=>$month){
		if ($key + 1 === $signupBirthMonth){
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'" selected>' .$month ."</option> \n";
		} else {
			$signupMonthSelectHTML .= '<option value="' .($key + 1) .'">' .$month ."</option> \n";
		}
	}
	$signupMonthSelectHTML .= "</select> \n";
	
	//Tekitame aasta valiku
	$signupYearSelectHTML = "";
	$signupYearSelectHTML .= '<select name="signupBirthYear">' ."\n";
	$signupYearSelectHTML .= '<option value="" selected disabled>aasta</option>' ."\n";
	$yearNow = date("Y");
	for ($i = $yearNow; $i > 1900; $i --){
		if($i == $signupBirthYear){
			$signupYearSelectHTML .= '<option value="' .$i .'" selected>' .$i .'</option>' ."\n";
		} else {
			$signupYearSelectHTML .= '<option value="' .$i .'">' .$i .'</option>' ."\n";
		}
		
	}
	$signupYearSelectHTML.= "</select> \n";
?>
<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Sisselogimine v�i uue kasutaja loomine</title>
</head>
<body>
	<h1>Logi sisse!</h1>
	<p>Siin harjutame sisselogimise funktsionaalsust.</p>
	
	<form method="POST">
		<label>Kasutajanimi (E-post): </label>
		<input name="loginEmail" type="email" value="<?php echo $loginEmail; ?>">
		<br><br>
		<input name="loginPassword" placeholder="Salas�na" type="password">
		<br><br>
		<input type="submit" value="Logi sisse">
	</form>
	
	<h1>Loo kasutaja</h1>
	<p>Kui pole veel kasutajat....</p>
	
	<form method="POST">
		<label>Eesnimi </label>
		<input name="signupFirstName" type="text" value="<?php echo $signupFirstName; ?>">
		<span><?php echo $signupFirstNameError; ?></span>
		<br>
		<label>Perekonnanimi </label>
		<input name="signupFamilyName" type="text" value="<?php echo $signupFamilyName; ?>">
		<br>
		<label>Teie s�nnikuup�ev</label>
		<?php
			echo $signupDaySelectHTML .$signupMonthSelectHTML .$signupYearSelectHTML;
		?>
		<br><br>
		<label>Sugu</label><span>
		<br>
		<input type="radio" name="gender" value="1" <?php if ($gender == '1') {echo 'checked';} ?>><label>Mees</label> <!-- K�ik l�bi POST'i on string!!! -->
		<input type="radio" name="gender" value="2" <?php if ($gender == '2') {echo 'checked';} ?>><label>Naine</label>
		<br><br>
		
		<label>Kasutajanimi (E-post)</label>
		<input name="signupEmail" type="email" value="<?php echo $signupEmail; ?>">
		<br><br>
		<input name="signupPassword" placeholder="Salas�na" type="password">
		<br><br>

		
		<input type="submit" value="Loo kasutaja">
	</form>
		
</body>
</html>