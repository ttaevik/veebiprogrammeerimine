window.onload= function(){
	document.getElementById("photoSubmit").disabled= true;
	document.getElementById("fileToUpload").addEventListener("change",checkSize);

}

function checkSize(){
	var fileToUpload = document.getElementById("fileToUpload").files[0];
	if(fileToUpload.size <=2097152){
		document.getElementById("photoSubmit").disabled= false;
		document.getElementById("fileSizeError").innerHTML = "";
	} else {
		document.getElementById("photoSubmit").disabled= true;
		document.getElementById("fileSizeError").innerHTML = "Fail on üle 2mb valige väiksem fail";	
	}
}