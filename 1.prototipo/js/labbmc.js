// Requisito para popovers duncionar
$(function () {
  $('[data-toggle="popover"]').popover()
})

$('.popover-dismiss').popover({
  trigger: 'focus'
})

// Icon Filtro (captivity)
$(".girar").click(function(){
	$("#girar").toggleClass("fa-flip-vertical")  ; 
})

// Janela de Historico de cada individuo (captivity)
function girar(id="girar" ) {
	 $(document).ready(function() {
	 	if ($("#"+id).hasClass("fa-chevron-up")) {
	 		$("#"+id).removeClass("fa-chevron-down");
	 		$("#"+id).removeClass("fa-chevron-up");
	 		$("#"+id).addClass("fa-chevron-down");
	 	} else {
	 		$("#"+id).removeClass("fa-chevron-up");
	 		$("#"+id).removeClass("fa-chevron-down");
	 		$("#"+id).addClass("fa-chevron-up");
	 	}
	 });
}


// Abrir o collapse de todos os historics e inverte os icons (captivity)
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

/* CAPTIVITY > WHOLE POPULATION */
$( ".hover-shadow" ).hover(
  function() {
    $( this ).addClass( "shadow" );
  }, function() {
    $( this ).removeClass( "shadow" );
  }
);

/* NAVBAR SUBDROPDOWN */
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