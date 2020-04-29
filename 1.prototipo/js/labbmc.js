// Rodar Botão: onclick div.girar -> roda o icon com id="girar"
$(".girar").click(function(){
	$("#girar").toggleClass("fa-flip-vertical")  ; 
})

// Usando onclick para enviar o id do item a ser girado
function girar(id="girar" ) {
  var element = document.getElementById(id);
  element.classList.toggle("fa-flip-vertical");
}