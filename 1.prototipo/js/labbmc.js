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
	  var emailReg =  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
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
if ($("#password").length) {
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
}

/* ADICIONA OU REMOVE LINHA DE INPUTS EM "CAPTIVITY_INSERT.PHP" */
if ($("#hidden_institute").length) {
	//https://stackoverflow.com/questions/25856704/how-can-i-access-an-array-declared-in-an-html-hidden-input-from-a-javascript-fun
	$(document).ready(function(){

		$(this).on("click",".add_historic",function(){
			var institute = document.getElementById("hidden_institute").value.split(',');
			var id_institute = document.getElementById("hidden_id_institute").value.split(',');
			var events = document.getElementById("hidden_events").value.split(',');
			var id_events = document.getElementById("hidden_id_events").value.split(',');
			var html = '<div class="row">\
				<div class="form-group col">\
					<label>Event:</label>\
					<select name="event[]" class="form-control form-control-sm">\
						<option selected disabled>Choose...</option>';
						for (var i = 0; i < id_events.length; i++) {
							html+='<option value="'+id_events[i]+'">'+events[i]+'</option>';
						}
			html+=	'</select>\
				</div>\
				<div class="form-group col">\
					<label>Date:</label>\
					<input type="date" name="date[]" class="form-control form-control-sm">\
				</div>\
				<div class="form-group col">\
					<label>Population:</label>\
					<select name="institute[]" class="form-control form-control-sm">\
						<option selected disabled>Choose...</option>';
						for (var i = 0; i < id_institute.length; i++) {
							html+='<option value="'+id_institute[i]+'">'+institute[i]+'</option>';
						}
			html+=	'</select>\
				</div>\
				<div class="form-group col">\
					<label>ID local:</label>\
					<input type="text" name="local_id[]" class="form-control form-control-sm" placeholder="Identifier at the specific institution">\
				</div>\
				<div class="form-group col">\
					<label style="white-space: nowrap;">Observation:</label>\
					<input type="text" name="observation[]" class="form-control form-control-sm" placeholder="Autopsy or extra information">\
				</div>\
				<div class="form-group col-lg-1 mt-auto px-1">\
					<span class="btn btn-sm btn-block btn-danger float-center remove_historic" style="white-space: nowrap;">Remove</span>\
				</div>\
			</div>';
			$(".historic").append(html);
		});

		$(this).on("click",".remove_historic",function(){
			var target_input = $(this).parentsUntil(".historic");
			target_input.remove();
		});
	});
}

function deleteHistoric(id) {
	$("#historic"+id).remove();
	html= '<input type="hidden" name="remove_historic[]" value="'+id+'">';
	$(".historic").append(html);
    alert("Deleted!");
}

/* MUDA VALOR DO HIDDEN ACTION */
function changeValue(id, value){
    document.getElementById(id).value = value;
    return true;
}

/* ADICIONA OU REMOVE LINHA DE INPUTS EM "genomics_insert.php" */
if ($("#genomic").length) {
	$(document).ready(function(){

		$(this).on("click",".add_genomic",function(){
			var html = '<div class="row">\
							<div class="form-group col">\
								<label> Platform:</label>\
								<input type="text" name="insert_platform[]" list="datalistPlatform" class="form-control form-control-sm" placeholder="e.g. NCBI, PUBMED, etc" required>\
							</div>\
							<div class="form-group col">\
								<label> Link:</label>\
								<input type="text" name="insert_link[]" class="form-control form-control-sm" placeholder="Acess on..." required>\
							</div>';
				html+=	'	<div class="form-group col-lg-1 mt-auto px-1">\
								<span class="btn btn-sm btn-block btn-danger float-center remove_genomic" style="white-space: nowrap;">Remove</span>\
							</div>\
						</div>';
			$(".genomic").append(html);
		});

		$(this).on("click",".remove_genomic",function(){
			var target_input = $(this).parentsUntil(".genomic");
			target_input.remove();
		});
	});
}

function deleteItem(page,id) {
	$("#"+page+id).remove();
	html= '<input type="hidden" name="remove[]" value="'+id+'">';
	$("."+page).append(html);
}

/*REQUEST FOR THE TOOLTIPS WORK*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/* COPY TEXT */
function copy(id){
	var copyTextarea = document.getElementById(id);
	copyTextarea.select(); //select the text area
	document.execCommand("copy"); //copy to clipboard
}