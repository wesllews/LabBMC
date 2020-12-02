/*OPEN ALL COLLAPSES OF HISTORICS*/
	$("#showAll").click(function(){
		$("#showAll").toggleClass("fa-chevron-up").toggleClass("fa-chevron-down");

		if ($("#showAll").hasClass("fa-chevron-up")) {
			$("ul.showAll").removeClass("show");
			$("div.card i.fas").removeClass("fa-chevron-down");
			$("div.card i.fas").removeClass("fa-chevron-up");
			$("div.card i.fas").addClass("fa-chevron-up");
			
		} else{
			$("ul.showAll").addClass("show");
			$("div.card i.fas").removeClass("fa-chevron-up");
			$("div.card i.fas").removeClass("fa-chevron-down");
			$("div.card i.fas").addClass("fa-chevron-down");
		}
	})

/* NAVBAR SUB DROPDOWN */
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
	    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');


	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	    $('.dropdown-submenu .show').removeClass("show");
	  });
	  return false;
	});

/* HOVER-SHADOW EFFECT */
	$( ".hover-shadow" ).hover(
	  function() {
	    $( this ).addClass( "shadow" );
	  }, function() {
	    $( this ).removeClass( "shadow" );
	  }
	);

/*REQUEST FOR THE POPOVERS WORK*/
	$(function () {
	  $('[data-toggle="popover"]').popover()
	});

	$('.popover-dismiss').popover({
	  trigger: 'focus'
	});

/* BUTTON 'GO TO TOP' */
	//Get the button
	var topbutton = document.getElementById("btnTop");

	// When the user scrolls down 200px from the top of the document, show the button
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
	  if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
	    topbutton.style.display = "block";
	  } else {
	    topbutton.style.display = "none";
	  }
	};

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
	  document.body.scrollTop = 0;
	  document.documentElement.scrollTop = 0;
	};

/* ENABLE SUBMIT BUTTON ON USERS PAGE*/ 
	//Disable change button if select wasn't changed
	function changeButton(id, valorAtual) {
		 $(document).ready(function() {
		 	if(document.getElementById("selectStatus"+id).value!=valorAtual){
		 	    document.getElementById("changeStatus"+id).disabled=false;
		 	} else{
		 		document.getElementById("changeStatus"+id).disabled=true;
		 	}
		 });
	}

/*VALIDA OS INPUTS DE CADASTROS*/
if ($("#register_name").length) {
	document.getElementById("register_name").addEventListener("focusout", function(){
		if(document.getElementById("register_name").value.length < 6){
	 		$("#register_name").addClass("is-invalid");
	 		document.getElementById("register_name-sm").textContent="Please, enter your entire name!";
	 	} else {
	 		$("#register_name").removeClass("is-invalid");
	 		$("#register_name").addClass("is-valid");
	 		document.getElementById("register_name-sm").textContent="";
	 	}
	});

	document.getElementById("register_institution").addEventListener("focusout", function(){
		if(document.getElementById("register_institution").value.length < 6){
	 		$("#register_institution").addClass("is-invalid");
	 		document.getElementById("register_institution-sm").textContent="Please, enter entire institution name!";
	 	} else {
	 		$("#register_institution").removeClass("is-invalid");
	 		$("#register_institution").addClass("is-valid");
	 		document.getElementById("register_institution-sm").textContent="";
	 	}
	});

	function validateEmail(email) {
	  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	  return emailReg.test( email );
	}
	document.getElementById("register_email").addEventListener("focusout", function(){
		email = document.getElementById("register_email").value;
		if(!validateEmail(email)){
			$("#register_email").addClass("is-invalid");
			document.getElementById("register_email-sm").textContent="Please, enter email in a valid format!";
			document.getElementById("register_email").focus();
		} else {
			$("#register_email").removeClass("is-invalid");
	 		$("#register_email").addClass("is-valid");
	 		document.getElementById("register_email-sm").textContent="";
		}
	});

	document.getElementById("register_justification").addEventListener("focusout", function(){
		if(document.getElementById("register_justification").value.length < 30 && document.getElementById("register_justification").value.toLowerCase()!="labbmc"){
	 		$("#register_justification").addClass("is-invalid");
	 		document.getElementById("register_justification-sm").textContent="Please, describe in your justification for accessing private data in at least 30 characters!";
	 	} else {
	 		$("#register_justification").removeClass("is-invalid");
	 		$("#register_justification").addClass("is-valid");
	 		document.getElementById("register_justification-sm").textContent="";
	 		if (document.getElementById("register_justification").value.toLowerCase()=="labbmc") {
	 			document.getElementById("register_justification").value="LabBMC";
	 		}
	 	}
	});

}

/* VALIDA AS SENHAS*/
 function validatepassword(password) {
  var passwordReg = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
  return passwordReg.test(password);
}
document.getElementById("password").addEventListener("focusout", function(){
	password = document.getElementById("password").value;
	if(!validatepassword(password)){
		$("#password").addClass("is-invalid");
		document.getElementById("password-sm").textContent="Please, enter a valid password!";
		document.getElementById("password").focus();
	} else {
		$("#password").removeClass("is-invalid");
 		$("#password").addClass("is-valid");
 		document.getElementById("password-sm").textContent="";
	}
});