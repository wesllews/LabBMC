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

// Disable change button if select wasn't changed
function changeaButton(id){
    
}

function changeButton(id, valorAtual) {
	 $(document).ready(function() {
	 	if(document.getElementById("selectStatus"+id).value!=valorAtual){
	 	    document.getElementById("changeStatus"+id).disabled=false;
	 	} else{
	 		document.getElementById("changeStatus"+id).disabled=true;
	 	}
	 });
}
