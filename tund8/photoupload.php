<?php
	require("functions.php");
	
	
	$notice="";
	
	
	
	//kui pole sisseloginud, siis sisselogimise lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login.php");
	}
	
	
	$target_dir = "../../pics/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	//pilt või ei
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			$notice .= "Fail on pilt - " . $check["mime"] . ". ";
			$uploadOk = 1;
		} else {
			$notice .= "fail pole pilt ";
			$uploadOk = 0;
		}
	}
	
	//Kas pilt on jub aolemas
	if (file_exists($target_file)) {
		$notice .= "Pilt juba olemas! ";
		$uploadOk = 0;
	}
	//failisuurus
	if ($_FILES["fileToUpload"]["size"] > 1000000) {
		$notice .= "Pilt on liiga suur! ";
		$uploadOk = 0;
	}
	
	//failityyp
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		$notice .= "lubatud failitüübid: JPG, JPEG, PNG ja GIF  ";
		$uploadOk = 0;
	}
	
	//Kas saab laadida?
	if ($uploadOk == 0) {
		$notice .= "Vabandust, pilti ei laetud üles! ";
	//Kui saab üles laadida
	} else {		
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " üles laetud ";
		} else {
			$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
		}
	}
?>

	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>
			Tauri Taevik veebiprogemise asjad
		</title>
	</head>
	<body>
		
		
		<p><a href="?logout=1">Logi välja</a>!</p>
		<p><a href="main.php">Pealeht</a></p>
		<hr> </hr>
		<h2>Lae uus foto</h2>
		<form action="photoupload.php" method="post" enctype="multipart/form-data">
			Vali pilt:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>
		
		<span><?php echo $notice; ?></span>
		
	</body>
	</html>