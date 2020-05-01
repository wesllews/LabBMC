// Requisito para popovers duncionar
$(function () {
  $('[data-toggle="popover"]').popover()
})

$('.popover-dismiss').popover({
  trigger: 'focus'
})
// Rodar Botão: onclick div.girar -> roda o icon com id="girar"
$(".girar").click(function(){
	$("#girar").toggleClass("fa-flip-vertical")  ; 
})

// Usando onclick para enviar o id do item a ser girado
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


// Abrir o collapse de todos os historics e inverte os icons
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
