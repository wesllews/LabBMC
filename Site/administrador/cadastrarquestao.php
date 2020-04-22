<?php 
session_start();
include "substituir.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
		include "conexao.php";
		$data=$_POST['data'];
		$excluido='n';
		$pergunta=$_POST['pergunta'];
		$pergunta=textobanco($pergunta);
		$ano_atual = date("Y");

		$a=$_POST['alternativaA'];
		$b=$_POST['alternativaB'];
		$c=$_POST['alternativaC'];
		$d=$_POST['alternativaD'];
		$e=$_POST['alternativaE'];
		$peso=$_POST['dificuldade'];	
		$resposta=$_POST['resposta'];
		$id_subunidade=$_POST['sub_uni'];
		$id_universidade=$_POST['universidade'];
		$dataexclu = "";
		if($resposta=='E' && $e=="")
		{
				$_SESSION['cont']=2;
					pg_close($conecta);
			header("Location: cadastrarquestao.php");
		}
		if ($data>$ano_atual || $data==""){
			
			$_SESSION['ola']=3;
					pg_close($conecta);
			header("Location: cadastrarquestao.php");
		}
	
		else{
			
			$sql="insert into questao(id_universidade,id_subunidade,peso,pergunta,a,b,c,d,e,resposta,excluido,data)
				values(
				$id_universidade,
				$id_subunidade,
				'$peso',
				'$pergunta',
				'$a',
				'$b',
				'$c',
				'$d',
				'$e',
				'$resposta',
				'$excluido',
				$data)";
			$resultado=pg_query($conecta,$sql);
			$linhas=pg_affected_rows($resultado);
			
			if ($linhas > 0){
				echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
				$sql="select * from questao ORDER BY id_questao DESC LIMIT 1";
				$resultado = pg_query($conecta, $sql);
				$qtde=pg_num_rows($resultado);
				if ($qtde > 0)
				{
					$linha=pg_fetch_array($resultado);
					//pegar o resultado e colocar na session:
					$_SESSION['id_questao']=$linha['id_questao'];
					header("Location: cadastroimagemquestao.php"); 

				}
			}
			else{
				echo "<script type='text/javascript'>alert('Erro na Gravação !!!')</script>";

			}
			
		}
		pg_close($conecta);

		exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../img/logos/sb.ico">
		<title>Softbio - Cadastro de Questões</title>
		
		<link href="assets/css/formatacaoconteudo.css" rel="stylesheet">
		
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/apendices.css" rel="stylesheet">
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<script src="../js/ie-emulation-modes-warning.js"></script>
		<link href="../css/carousel.css" rel="stylesheet">
		<link href="../css/cadastroquestoes.css" rel="stylesheet">

		<script src="../js/formulario.js"></script>
		<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../dist/css/bootstrapValidator.css"/>
	<script src="../js/codigos.js"></script>


<script src="../bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("../navbar.php?p=adm");		
    });
window.onbeforeunload = function(event) {
event.returnValue = "asdasdfasdf";
};
function tiraVerificacao(){
window.onbeforeunload = null;
};

</script>
	

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>	
	
  <script> 
   function validateAlternative() {

        alert("Name must be filled out");
    }
}
</script>	
	
	
 </head>
<div id="navbar"></div>
<body>
  <?php
  /*Início do php*/
  include "conexao.php";

?>

	<form action="cadastrarquestao.php" data-toggle="validator" onsubmit="tiraVerificacao();" method="POST" name="contact_form" id="contact_form">


	<div class="container-fluid">
		 <div class="row text-center" style="padding-top:25px; height:35%; margin-left:2px;" >
		<h1><b>Cadastro de Questões</b> </h1>
		</div>
	</div>
<!-- <a href="#" title="Instruções básicas" data-toggle="popover" data-trigger="hover" data-content="O conteúdo do SoftBio é dividido em slides, por favor, escolha as informações básicas e comece já a inserir os conteúdos! :)">            
   <span class="glyphicon glyphicon-question-sign hidden-xs" aria-hidden="true" style="font-size:35px; margin-top:10px;"></span>
</a>-->
	<div class="row">
		<div class="has-warning"><!--Mensagem de erro-->
			<div  class='col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
				<center><label for="warning" class="control-label">É obrigatório o preenchimento dos campos com *</label></center>
			</div>
		</div>
	</div>		  
          
	<div class="container-fluidcad">
	<fieldset>
	

		<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>
									   
						<label class="control-label"><b><h3>Pergunta:</b></h3></label><label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
						<div class="input-group">
					<textarea cols="54" rows="8" name="pergunta" class="form-control" maxlength="900" style="resize:none;" placeholder="Digite uma Pergunta Ex: Campo da biologia que estuda o reino vegetal?" required></textarea>
						  <span class="input-group-addon add-on"> </span>
						</div>
								
						<div class="help-block with-errors"></div>

		</div>
		
		
		<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>
			  <h3><b>Universidade</b></h3> 
					<div class="input-group">
		  
				<select name="universidade" id="universidade" class="form-control" required>
					<optgroup label="Universidades">
						<?php

							$sql1="select * from universidade";
							$resultado1= pg_query($conecta, $sql1);
							while($linha1 = pg_fetch_array($resultado1)){
							?>
								<option value="<?php echo $linha1[id_universidade]; ?>"><?php echo $linha1[sigla].'-'.$linha1[nome]; ?></option>
								
							<?php
							}
							?>
					</optgroup>
				</select>				
					<span class="input-group-addon add-on"></span><center> 
					  
			  </div><br>
		</div>
		

		<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>

		 
			<div class="form-group">		   
				   <b><h3>Dificuldade</b></h3>
					<div class="input-group">
				   <select class="form-control" name="dificuldade" required>
					  <optgroup label="Grau de dificuldade">
						<option value="Básico">Básica</option>
						<option value="Intensivo">Intensiva</option>  
					  </optgroup>
			</select>

				 <span class="input-group-addon add-on"></span>
				   </div>  
			  </div>
		</div>
		<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>
			
			<div class="form-group">		   
		<b><h3>Ano*:</b></h3>
		
	
	
		
			<?
	$cont=$_SESSION['ola'];
	$_SESSION['ola']=null;
		if($cont==3)
		{
		?>
<div class="alert alert-danger">
			<center><h4>É necessário que o ano cadastrado seja válido!</h4></center>
			
		</div>
			
	
	<?
	
		}
	
	?>
		
					<div class="input-group">

                  <input type="number"  name="data" pattern=".{4,10}" maxlength="4" onblur="somenteNumeros(this);" placeholder="Por exemplo:2017"class="form-control" required>
				  				 <span class="input-group-addon add-on"></span>

                </div></div>
				 <script>
    function somenteNumeros(num) {
        var er = /[^0-9.]/;
        er.lastIndex = 0;
		
        var campo = num;
		

        if (er.test(campo.value)) {
			alert("Digite apenas números");


          campo.value = "";
        }
		
    }
 </script>
		</div>
		    <div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
						<div class="form-group">		   

				   <b><h3>Subunidade</b></h3>
					<div class="input-group">
            <select class="form-control" name="sub_uni" required>
                <?php
					$sql1="select * from subunidade order by subunidade asc";
					$resultado1= pg_query($conecta, $sql1);
					while($linha1 = pg_fetch_array($resultado1)){
					?>
						<option value="<?php echo $linha1[id_subunidade] ?>"><?php echo $linha1[subunidade]; ?></option>
						
					<?php
					//$_SESSION['id_universidade']=$linha1[id_universidade];
					}
				?>
				
            </select>
				 <span class="input-group-addon add-on"></span>

        </div>
        </div>
    </div>

		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

						<label for="inputEmail" class="control-label"><b><h3>Alternativas:</b></h3></label>
						<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
						
							<div class="input-group">
							<div class="input-group-addon">A)</div>
							<input id="inputEmail" class="form-control"  placeholder="Digite uma Alternativa. Ex: Reino Vegetal." type="text" name="alternativaA"  required> 
							<span class="input-group-addon add-on"></span>

							</div>
		</div>
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							<div class="input-group-addon">B)</div>
							<input type="text" class="form-control" id="AlternativaB" name="alternativaB" placeholder="Digite uma Alternativa." required>
							<span class="input-group-addon add-on"></span>

							</div>					
		</div>
		
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							<div class="input-group-addon">C)</div>
							<input type="text" class="form-control" id="AlternativaC" name="alternativaC" placeholder="Digite uma Alternativa." required>
							<span class="input-group-addon add-on"></span>
							</div>
		</div>
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
			
							<div class="input-group">
							<div class="input-group-addon">D)</div>
							<input type="text" class="form-control" id="AlternativaD" name="alternativaD" placeholder="Digite uma Alternativa." required>
							<span class="input-group-addon add-on"></span>

							</div>
		</div>
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							<div class="input-group-addon">E)</div>
							<input type="text" class="form-control" id="AlternativaE"  name="alternativaE" placeholder="Digite uma Alternativa." >
							  
							<span class="input-group-addon add-on"></span>

							</div>
									
					
		</div>
				<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
	<?
	$cont=$_SESSION['cont'];
	$_SESSION['cont']=null;
		if($cont==2)
		{
		?>
<div class="alert alert-danger">
			<center><h4>Para está resposta, cadastre uma alternativa E!</h4></center>
			
		</div>
			
	
	<?
	
		}
	
	?>
			
				</div>

		
		
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">
	

	



						<label for="inputEmail" class="control-label"><b><h3>Resposta:</b></h3></label>
						<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
						<div class="input-group">
						
					
						<select class="form-control" name="resposta" required>
							
							  <optgroup label="Grau de dificuldade">
								<option value="A">Alternativa A</option>
								<option value="B">Alternativa B</option>
								<option value="C">Alternativa C</option>  
								<option value="D">Alternativa D</option>  
								<option value="E">Alternativa E</option>  
							  </optgroup>
						</select>
						<span class="input-group-addon add-on"></span>
						
						</div>
						

		</div>
		<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary"  >Enviar</button></center>
		  </div>
		 </div>

		</form>			

	</fieldset>
		
	</div>
		
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/holder.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 
	

	 <div class="row">
		 <hr>
			<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://200.145.153.172/hope/tcc/administrador/index.php" class="btn btn-primary" onclick="tiraVerificacao();" >Voltar</a>
			</center>
		<br>
	</div>
</div>		



</body>

<div id="footer">
</div>

</html>





