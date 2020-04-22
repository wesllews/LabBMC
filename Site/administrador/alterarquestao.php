<?php 
session_start();
include "substituir.php";

		include "conexao.php";
?>

<!DOCTYPE html>
<html lang="en">
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
    });</script>
	
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>	
	
	
	
 </head>
<div id="navbar"></div>
<body>
  <?php
  /*Início do php*/
  include "conexao.php";

?>
<div class="contentpagina">

	<form action="gravaalteraquestao.php" data-toggle="validator"  method="POST" name="contact_form" id="contact_form">


	<div class="container-fluid">
		 <div class="row text-center" style="padding-top:25px; height:35%; margin-left:2px;" >
		<h1><b>Alteração de Questões</b> </h1>
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
	<?php 
	$idquestao=$_POST['id'];
	$_SESSION['id_questao']=$idquestao;
	$sql = "select * from questao where  id_questao='$idquestao'"; 
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
	$linha=pg_fetch_array($resultado);	
	
	?>

		<div class='form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1'>
									   
						<label class="control-label"><b><h3>Pergunta:</b></h3></label><label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
						<div class="input-group">
					<textarea cols="54" rows="8" name="pergunta" class="form-control" maxlength="800" style="resize:none;" placeholder="Digite uma Pergunta Ex: Campo da biologia que estuda o reino vegetal?" value="<?php echo $linha[pergunta]; ?>" required><?php echo textoinput2($linha[pergunta]); ?></textarea>
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

							$sql1="select * from universidade order by nome asc";
							$resultado1= pg_query($conecta, $sql1);
							while($linha1 = pg_fetch_array($resultado1)){
								$selectUni="";
								if($linha[1] == $linha1[id_universidade])
									$selectUni="selected";

							?>
								<option <?php echo $selectUni;?> value="<?php echo $linha1[id_universidade]; ?>"><?php echo $linha1[sigla].'-'.$linha1[nome]; ?></option>
								
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
				   <b><h3>Dificuldade da questão</b></h3>
					<div class="input-group">
				   <select class="form-control" name="dificuldade" required>
					  <optgroup label="Grau de dificuldade">[
					  <?php 
					  if($linha['peso']=='Básico'){
						  echo"
						<option value='Básico'selected>Básica</option>
						<option value='Intensivo'>Intensiva</option>  ";
					  }
					  else if($linha['peso']=='Intensivo'){
						  echo"
						<option value='Básico'>Básica</option>
						<option value='Intensivo' selected>Intensiva</option>  ";
					  }
					  ?>
					
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
			<center><h4>Cadastre um ano correto!</h4></center>
			
		</div>
			
	
	<?
	
		}
	
	?>
		
					<div class="input-group">

                  <input type="number" name="data" pattern=".{4,10}" maxlength="4" onkeyup="somenteNumeros(this);" placeholder="2017" value="<?php echo $linha[data]; ?>" class="form-control" required>
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
					$sql1="select * from subunidade";
					$resultado1= pg_query($conecta, $sql1);
					while($linha1 = pg_fetch_array($resultado1)){

						$selectSub="";
								if($linha[id_subunidade] == $linha1[id_subunidade])
									$selectSub="selected";
					?>
						<option <?php echo $selectSub;?> value="<?php echo $linha1[id_subunidade] ?>"><?php echo $linha1[subunidade]; ?></option>
						
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
							<input id="inputEmail" class="form-control"  placeholder="Digite uma pergunta. Ex: O que biologia estuda?" type="text" value="<?php echo $linha[a]; ?>" name="alternativaA"  required> 
								<span class="input-group-addon add-on"></span>

							</div></div>
									<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							  <div class="input-group-addon">B)</div>
							  <input type="text" class="form-control" id="AlternativaB" name="alternativaB" placeholder="B" value="<?php echo $linha[b]; ?>" required>
				 <span class="input-group-addon add-on"></span>

							</div>
							</div>
							<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							  <div class="input-group-addon">C)</div>
							  <input type="text" class="form-control" id="AlternativaC" name="alternativaC" placeholder="C" value="<?php echo $linha[c]; ?>" required>
				 <span class="input-group-addon add-on"></span>

							</div>
								</div>
									<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							  <div class="input-group-addon">D)</div>
							  <input type="text" class="form-control" id="AlternativaD" name="alternativaD" placeholder="D" value="<?php echo $linha[d]; ?>" required>
				 <span class="input-group-addon add-on"></span>

							</div>							</div>
									<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

							<div class="input-group">
							  <div class="input-group-addon">E)</div>
							  <input type="text" class="form-control" id="AlternativaE"  name="alternativaE" value="<?php echo $linha[e]; ?>"placeholder="E" >
				 <span class="input-group-addon add-on"></span>

							</div>							</div>

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
						<div class="help-block with-errors"></div>
					
		</div>
		
		<div class="form-group col-md-6 col-xs-10 col-md-offset-3 col-xs-offset-1">

						<label for="inputEmail" class="control-label"><b><h3>Resposta:</b></h3></label>
						<label for="warning" class="control-label" style="color: #8a6d3b;"><h3>*</h3></label>
						<div class="input-group">
						
					
						<select class="form-control" name="resposta" required>
							
					  <?php 
					  if ($linha['resposta']=="A")
						echo "
								<option value='A' selected>Alternativa A</option>
								<option value='B'>Alternativa B</option>
								<option value='C'>Alternativa C</option>  
								<option value='D'>Alternativa D</option>  
								<option value='E'>Alternativa E</option> "; 
					  if ($linha['resposta']=="B")
						echo "  
								<option value='A'>Alternativa A</option>
								<option value='B' selected>Alternativa B</option>
								<option value='C'>Alternativa C</option>  
								<option value='D'>Alternativa D</option>  
								<option value='E'>Alternativa E</option> "; 
					  if ($linha['resposta']=="C")
						echo "  
								<option value='A'>Alternativa A</option>
								<option value='B'>Alternativa B</option>
								<option value='C' selected>Alternativa C</option>
								<option value='D'>Alternativa D</option>  
								<option value='E'>Alternativa E</option> "; 
					  if ($linha['resposta']=="D")
						echo "  
								<option value='A'>Alternativa A</option>
								<option value='B'>Alternativa B</option>
								<option value='C'>Alternativa C</option>  
								<option value='D' selected>Alternativa D</option>
								<option value='E'>Alternativa E</option> "; 
					  if ($linha['resposta']=="E")
						echo "  
								<option value='A'>Alternativa A</option>
								<option value='B'>Alternativa B</option>
								<option value='C'>Alternativa C</option>  
								<option value='D'>Alternativa D</option>  
								<option value='E' selected>Alternativa E</option>";
						
						?>

				   </select>

				 <span class="input-group-addon add-on"></span>

						</div>
						

		</div>
		<hr>
		<br>





	<div class="row">
		  <div class='form-group col-md-12 col-xs-12'>
		  <center><button type="submit" class="btn btn-primary">Editar</button>
			&emsp;&emsp;&emsp;&emsp;	  
		  <!--janela modal, código adaptado de Maurício 'Maujor' Samy Silva-->
		  <?php if($linha["excluido"]=="n")
				{
					?>
		<a href="#modalexcluir" data-toggle="modal" class="btn btn-primary" >Excluir</a>
			<?php
				} 
			else{
				?>
				<a href="#modalreativar" data-toggle="modal" class="btn btn-primary" >Reativar</a>
				<?php
			}
				?>
		</div>

	</div>
</div>

	
	
	 </form>
	 
	 <!--      modalll    -->
	 

	
	  </fieldset>
	  </div>

	 
</div>

	 <div  class="modal fade" id="modalexcluir" tabindex="-1" role="dialog" aria-labelledby="modalexcluirLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente excluir esta questão?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="exclusaoquestao.php" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							
				<button type="submit" class="btn btn-primary" id="finalizar">Excluir</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
			<!--
            <div class="modal-footer">
              
            </div>-->
        </div> 
			</div>  
  
    
    
          </font>

    
    </div> <!-- /.col-* --> 
	
	<!-- outro modal -->
	
	 <div  class="modal fade" id="modalreativar" tabindex="-1" role="dialog" aria-labelledby="modalreativarLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
      			<div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title"><b>Deseja realmente reativar esta questão?</b></h3>
      			</div>
            <div class="modal-body" id="modaltexto">
              <form action="reativarquestao.php" method="post">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
				<button type="submit" class="btn btn-primary" id="finalizar">Reativar</button>
								
				<button type='button' class='btn btn-primary' data-dismiss='modal'>Cancelar</button>
				 
				
			</form>
            </div>
		
        </div> 
			</div>  
      
          </font>
    
	
    </div> 
	<!--     modal-->
  

		<script src="../js/bootstrap.min.js"></script>
	    <script src="../js/bootstrapvalidator.min.js"></script> 
	    <script src="../js/cadastro.js"></script> 

 <div class="row">
		 <hr>
			<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://200.145.153.172/hope/tcc/administrador/menuquestoes.php" class="btn btn-primary" onclick="tiraVerificacao();" >Voltar a lista</a>
			</center>
		<br>
	</div>


</div>
	<footer id="footer" class="footer">
	</footer>

 </body>

</html>