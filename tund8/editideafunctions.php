<?php

	require("../../config.php");
	$database = "if17_ttaevik_2";
	
	// loeme mõtted muutmiseks
	function getSingleIdea($editid){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT idea, ideacolor FROM vpuserideas WHERE id=?");
		$stmt->bind_param("i",$editid);
		$stmt->bind_result($idea, $color);
		$stmt->execute();
		$ideaObject= new stdclass();
		if($stmt->fetch()){
			$ideaObject->text= $idea;
			$ideaObject->color= $color;			
		}
		
		
		
		$stmt->close();
		$mysqli->close();
		return $ideaObject;
		
	}


	function updateIdea($id, $idea, $ideacolor){
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE vpuserideas SET idea=?, ideacolor=? WHERE id=?");
		$stmt->bind_param("ssi",$idea, $ideacolor, $id);
		if($stmt->execute()){
			echo "õnnestus";
		} else{
			echo "tekkis viga".$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		
		
	}
	
	function deleteIdea($id){
	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("UPDATE vpuserideas SET deleted=NOW() WHERE id=?");
	$stmt->bind_param("i",$id);
	$stmt->execute();	
	
	$stmt->close();
	$mysqli->close();
	
	}

?>