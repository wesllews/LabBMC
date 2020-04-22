/*Função adaptada de Elizabete Munzlinger*/
function validaEmail(){
	email = document.login.email.value;
	
	if((email.length < 8) || 
	(email.indexOf(" ") != -1) ||
	(email.indexOf("..") != -1) ||
	(email.indexOf(".@") != -1) ||
	(email.indexOf("@.") != -1) ||
	(email.indexOf("@") < 2) ||
	(email.indexOf("@") != email.lastIndexOf("@")) ||
	(email.indexOf(".",email.indexOf("@"))<email.indexOf("@")+3) ||
	(email.lastIndexOf(".") > email.length - 3) ||
	(email.indexOf(".") == 0)
	){
		document.login.email.style.backgroundColor="#F9B1B1";

		return false;
	}
else{
			document.login.email.style.backgroundColor="white";
	return true;
}	
	
}

