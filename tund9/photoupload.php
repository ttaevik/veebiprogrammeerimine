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
	
	// FOTO ÜLESLAADIMINE
	
	
	$target_dir = "../../pics/";
	$target_file = "";
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$maxWidth=600;
	$maxHeight=400;
	$marginVer= 10;
	$marginHor= 10;
	
	//Kas vajutati üleslaadimisnuppu
	if(isset($_POST["submit"])) {
		
		if(!empty($_FILES["fileToUpload"]["name"]));{
			
			//ENNEM $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			
			$imageFileType = strtolower (pathinfo(basename($_FILES["fileToUpload"]["name"]))["extension"]);
			$timeStamp = microtime(1) *10000;
			$target_file = $target_dir . pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .$timeStamp ."." .$imageFileType;

			
			
			
			
			//Kas on pilt või ei- kontrollitakse piksli arvu
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Tegemist on pildifailiga - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "Tegemist pole pildifailiga ";
				$uploadOk = 0;
			}
			
				//Kas pilt on juba olemas
		if (file_exists($target_file)) {
			$notice .= "Vabandage, pilt juba olemas! ";
			$uploadOk = 0;
		}
		//failisuurus
		if ($_FILES["fileToUpload"]["size"] > 1000000) {
			$notice .= "Pilt on liiga suur! ";
			$uploadOk = 0;
		}
		
		//failityyp
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$notice .= "Lubatud failitüübid: JPG, JPEG, PNG ja GIF  ";
			$uploadOk = 0;
		}
		
		//Kas saab laadida?
		if ($uploadOk == 0) {
			$notice .= "Tekkis viga, pilti ei laetud üles! ";
		//Kui saab üles laadida
		} else {		
			/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " üles laetud ";
			} else {
				$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
			}*/
			
			//muudame suurust
			//lähtudest failitüübist, loome pildiobjekti
			if($imageFileType == "jpg" or $imageFileType == "jpeg"){
				$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
				
			}
			if($imageFileType == "png" ){
				$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
			
			}
			
			if($imageFileType == "gif" ){
				$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
			
			}
			
			$imageWidth= imagesx($myTempImage);
			$imageHeight= imagesx($myTempImage);
			
			$sizeRatio= 1;
			if($imageWidth > $imageHeight){
				$sizeRatio= $imageWidth / $maxWidth;
			} else {
				$sizeRatio= $imageHeight / $maxHeight;
			}	
			
			$myImage = resize_image($myTempImage,$imageWidth,$imageHeight,round($imageWidth / $sizeRatio),round($imageHeight / $sizeRatio));
			
			//lisame vesimärgi
			$stamp = imagecreatefrompng("../../grapics/hmv_logo.png");
			$stampWidth= imagesx($stamp);
			$stampHeight= imagesx($stamp);
			$stampPosX= round($imageWidth / $sizeRatio)- $stampWidth - $marginHor;
			$stampPosy= round($imageHeight / $sizeRatio)- $stampHeight - $marginVer;
			imagecopy($myimage,$stamp ,$stampPosX, $stampPosy, 0, 0, $stampWidth, $stampHeight );
			
			//lisame ka teksti
			$txtToImage= "Minu pilt!";
			// loen EXIF infot
			@$exif= exif_read_data($_FILES["fileToUpload"]["name"], "ANY_TAG",0 , true);
			if(!empty($exif["DateTimeOriginal"])){
				$txtToImage= "pilt tehti: " .$exif["DateTimeOriginal"];
			}else{
				$txtToImage="pildistamise aeg teadmata";
			}	
				
			//värv
			//imagecolorallocate- ilma läbipäistvusteta
			//alpha 0-127
			$textColor= imagecolorallocatealpha($myImage, 150, 150, 150, 50);
			imagettftext($myImage, 20, 0, 10, 25,$textColor, "../../graphics/ARLRDBD.TTF",$txtToImage ;
			
			//salvestame pildifaili
			if($imageFileType == "jpg" or $imageFileType == "jpeg"){
				if(imagejpeg($myImage, $target_file, 90)){
					$notice = "fail: ".basename($_FILES["fileToUpload"]["name"] ."laeti üles.");
					
				} else {
					$notice = "faili üleslaadimisel tekkis viga.";
				}	
			}
				
			if($imageFileType == "png"){
				if(imagejpeg($myImage, $target_file, 90)){
					$notice = "fail: ".basename($_FILES["fileToUpload"]["name"] ."laeti üles.");
					
				} else{
					$notice = "faili üleslaadimisel tekkis viga.";
				}	
			}
			
			if($imageFileType == "gif"){
				if(imagejpeg($myImage, $target_file, 90)){
					$notice = "fail: ".basename($_FILES["fileToUpload"]["name"] ."laeti üles.");
					
				} else{
					$notice = "faili üleslaadimisel tekkis viga.";
				}	
			}

			//vabastame mälu
			imagedestroy($myTempImage);
			imagedestroy($myimage);	
		}
		
	
			
		
	}//KAS failinimi on olemas LÕPPEB
	}//Kas üles laadida LÕPPEB
	
	function resize_image($image,$origW,$origH,$w,$h){
		$dst = imagecreatetruecolor($w,$h);
		imagecopyresampled($dst,$image, 0, 0, 0, 0, $h, $w, $origW, $origH);
		return $dst;
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