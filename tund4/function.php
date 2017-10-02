<?php

$database = "if17_ttaevik_2";

//alustame sessiooni
session_start();

function signIn ($email, $password){
	$notice= "";
	
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	
	$stmt = $mysqli->prepare("SELECT id, email, password FROM vpusers WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
	$stmt->execute();
	
	//kui vähemalt üks tulemus 
	if ($stmt->fetch()){
		$hash = hash("sha512", $password);
		if($password == $passwordFromDb){
			$notice= "sisselogitud!";
			//määransessiooni muutujaid
			$_SESSION["userId"]= $id;
			$_SESSION["userEmail"] = $emailFromDb;
			
			
			//lähen pealehele
			header("location: main.php");
			exit();
		
		} else {
			$notice= "vale sanasõna";
		}
	}else {
		$notice= "sellise e-postiga kasutajat pole";
	}
	$stmt->close();
	$mysqli->close();
	return $notice;
	}

function signup($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
	//loon ühenduse serveriga
	

	// käsk andmebaasile
	$stmt = $mysqli ->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
	echo $mysqli-> error;
	//s - string, tekst
	//i - integar, täisarv
	//d- decimal,ujukoma
	$stmt->bind_param("sssiss",$signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
	//stmt->execute ();
	if($stmt->execute()){
		echo "õnnestus!";
	}	else {
		echo "tekkis viga: " .$stmt-> error;
	}
	
	}
	
	
	
	
function test_input($data){
		$data = trim($data); // eemaldab liigsed tühikus, reavahetused, TAB ja muu sellise
		$data = stripslashes($data); //eemaldab kaldkriipsud
		$data = htmlspecialchars($data);
		return $data;
		
	}
	/*
	$x=7;
	$y=4;
	//echo "esimene summa on: " .($x + y$) ."\n";
	addValues();
	
	function addValues(){
		echo "teine summa on: " ($x +$y). "\n";
		$a=7;
		$b=4;
		echo "kolmas summa on: " ($a +$b). "\n";
	}
	*/
?>