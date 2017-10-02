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
	
	<Table border="1" style= "border-collapse: collapse:"> 
		<tr> 
			<th>eesnimi</th>
			<th>perekonnanimi</th>
			<th>kasutajanimi</th>
		</tr>
		<tr>
			<td>Tauri</td>
			<td>Taevik</td>
			<td>ttaevik@gmail.com</td>
		</tr>
		<tr>
			<td>Karus</td>
			<td>Mari</td>
			<td>karus.mari@tlu.ee</td>
		</tr>
	
	</table>
	
	
	
	
</body>
</html>