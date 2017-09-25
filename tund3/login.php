
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
	Logige sisse või looge uus konto
	</h1>
		
		
	<h2> Looge uus konto </h2>
	
	<form method="POST">
		<label> Eesnimi: </label>
		<input name="signupFirstName" type="text" value="<?php if(isset($_POST["signupFirstName"])){echo $_POST["signupFirstName"];}?>">
	
	<br> <label> Perekonnanimi: </label>
		<input name="signupFamilyName" type="text" value="<?php if(isset($_POST["signupFamilyName"])){echo $_POST["signupFamilyName"];}?>">
	
	<br>	<label> Sisestage sugu: </label>
		<br> <label> mees</label><input type="radio" name="gender" value="1">
		<br> <label> naine</label><input type="radio" name="gender" value="2">
		
	<br>	<label> Kasutajanimi: </label>
		<input name="signupEmail" type="email" value="<?php if(isset($_POST["signupEmail"])){echo $_POST["signupEmail"];}?>">
		
	<br>	<label> Looge parool: </label>
		<input name="signupPassword" type="password">	
		
		
	<br><input type="submit" value="Loo konto">
	</form>
	
	

	
	
	
	<h2> Logi sisse </h2>
	<p> Sisestage oma kasutajanimi</p>
	<form method="POST">
		<label> kasutajanimi: </label>
		<input name="loginEmail" type="email" value="<?php if(isset($_POST["loginEmail"])){echo $_POST["loginEmail"];}?>">
	
	<p> Sisestage oma parool</p>
	
		<label> parool: </label>
		<input name="loginPassword" type="password">
	
	<br><input type="submit" value="Logi sisse">
	</form>
	
</body>
</html>