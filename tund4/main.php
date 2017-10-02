<?php


require ("function.php");
//kui pole sisse logitud, liigume login lehele
if(!isset($SESSION["userId"])){
	header("Location: login.php");
	exit();
}

//välja logimine
if(isset($_GET["logout"])){
	session_destroy();// lõpetab sessiooni
	header("Location: login.php");
}
	

$picsDir = "../../pics/";
$picFiles = [];
$picFileType = ["jpg", "jpeg","png", "gif"];

$allFiles = array_slice(scandir($picsDir),2);

foreach ($allFiles as $file){
	$fileType = pathinfo ($file, PATHINFO_EXTENSION);
	if (in_array($fileType, $picFileType) == true){
		array_push($picFiles, $file);
	}
}

//var_dump($picFiles);
$fileCount = count ($picFiles);
$picNumber = mt_rand(0,($fileCount-1));
$picFile = $picFiles[$picNumber];

	
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
	
	
	
	
	
	
	<p><a href="?logout=1">logi välja</a></p>
	<p><a href="usersInfo.php">info kasutajate kohta</a></p>
	
	<h2> Pilte ülikoolist</h2>
	<img src="<?php echo $picsDir ,$picFile; ?>" alt="tallinna ülikool">
	<img src="../../pics/tlu_13.jpg" alt="tallinna ülikool\n">
	<img src="../../pics/tlu_20.jpg" alt="tallinna ülikool">
	
	
	
	
</body>
</html>