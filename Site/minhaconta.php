<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	 <link rel="icon" href="img/logos/sb.ico">


    <title>Softbio - Minha Conta</title>
<link href="css/bootstrap-theme.css" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <link href="css/continha.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	<script src="js/formulario.js"></script>
	<script src="js/codigos.js"></script>
<script src="bootstrap/jquery.js"></script>
    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  $("#navbar").load("navbar.php?p=minhaconta"); 
    });
</script>

  </head>

</head>
<div id="navbar">
	
</div>

<body>
			<?php
			include "conecta.php";
			session_start();

			if (!isset($_SESSION["logou"]))
			{
				header("Location: login.php");

			}
					
			if($_SESSION["email"]==null)
			{
					$email=$_SESSION["usuario"];
					
					$email = strtolower($email);
				
			}
			else
			{
				
				$email=$_SESSION["email"];
				
				$email = strtolower($email);
				$_SESSION["usuario"]=$email;
			

			}

			$_SESSION["batata"]=$email;
			$_SESSION["minhaconta"]=1;
			
			$sql="select * from cadastro where email='$email'";

				 

			 $resultado2= pg_query($conecta, $sql);
			 $qtde2=pg_num_rows($resultado2);
			 if ($qtde2 > 0)
			 {
				$linha2=pg_fetch_array($resultado2);
			 }
					 ?>

			 
				<div class="contentpagina">
			<form action="editardados.php" method="post">

				
								
											<div class="row"><!--Título-->
												<div class="col-lg-12">
													<center>
														<h1>Minha conta<br>
														<small>Verifique se seus dados estão corretos</small>
														
														</h1>
													</center>
												</div>
											</div>
									
									  

							<br>
								
									<div class="row">
										<center><h4>Informações pessoais</h4>
							<hr></center>
											<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>

											

											<label for="inputEmail" class="control-label"><b><h4>E-mail:</b></h4></label>
										<br>
											<?php  echo $linha2["email"];?>
											
									
										</div>
										<br>

										<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
														   
											<label for="textNome" class="control-label"><b><h4>Nome:</b></h4></label>
											<br>
											
											
													<?php
													$nome= $linha2["nome"];
													echo  ucwords($nome) ?>
											
										</div>


								<br>

								

									  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
									  <label for="textnasc" class="control-label"><b><h4>Nascimento:</b></h4></label>
									  <br>

									  <?php 
									  $nascimento=$linha2["datanasc"];
									  echo date('d/m/Y',  strtotime($nascimento)); ?>
											
									  
									  </div>
							</div>


							   
									<br>

							<div class="row">

							<center><h4>Informações do curso</h4>
							<hr></center>

									  <div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
									  <label for="textuniv" class="control-label"><b><h4>Universidade:</b></h4></label>
									  <br>
									  
									 <?php 
									 $univer =  $linha2["id_universidade"]; //id_universidade
									 $sqlun="select nome from universidade where id_universidade=$univer";

							 $resultado1= pg_query($conecta, $sqlun);
							 $qtde1=pg_num_rows($resultado1);
							 if ($qtde1 > 0)
							 {
									 $linha1=pg_fetch_array($resultado1);
									 ?>
								
									 <?php echo $linha1['nome']?>
							 <?}?>
									</div>
									<br>

							<div class='form-group  col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							 
											   
									   <label for="textdif" class="control-label"><b><h4>Dificuldade do curso SoftBio:</b></h4></label>
									   <br>
											<?php 
											$dificuldadecurso=strtolower( $linha2["dificuldade"]);
											echo $linha2["dificuldade"];?>


							</div>


									<div class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
														   
											<label for="textCurso" class="control-label"><b><h4>Curso universitário desejado:</b></h4></label>
											<br>
											<?php echo $linha2["curso"]?>
											  
								</div>
								
								<br><br><br>
								<center>
								<div class="row">
							<br>
								
									 <div class='form-group col-md-4 col-xs-3 col-xs-offset-2 col-md-offset-3'>
								
									<a href="editardados.php">
											
								   <input type="button" class="btn btn-primary" value="Editar dados"/></a>
									 
							</div>
							   
							   <div class='form-group col-md-1 col-xs-1 col-xs-offset-1 col-md-offset-0'>
									
								
									
							   <a href="alterarsenha.php">
							   <input type="button" class="btn btn-primary" value="Editar senha"/></a>

									  </div>
									
								
																						
							</div> 
							</center>

								<div class="row">
										<br>
										<center>
											 <div class='form-group col-md-3 col-xs-5 col-md-offset-3 col-xs-offset-2'>
													 <div id="estadousuario" class="grow">
																 <br>
																  
																  <?php
																  $usuario =  $linha2['email'];

														$sqlp="select * from cronograma where email='$usuario'";

														 $resultadop= pg_query($conecta, $sqlp);
														  $qtdep=pg_num_rows($resultadop);
														 if ($qtdep <= 0)
														 {

														 ?>
															 <center><h5>Bem vindo ao SoftBio!</h5> 
															 <a href="paggeralcont.php">Iniciar estudos</a> </center><br>
														 
														  
														  <?php
														 }
															
															
															if($dificuldadecurso=='intensivo'){
													$sqlsub="select id_subunidade from subunidade where excluido='n'";
												}
												else{
													$sqlsub="select id_subunidade from subunidade where lower(dificuldade)='$dificuldadecurso' and excluido='n'";
												}

												$resultadosub= pg_query($conecta, $sqlsub);
												$qtdesub=pg_num_rows($resultadosub);
												
												$subunidadestot=$qtdesub;
												//arrumar a cagada de baixo
												

																  $sql2="select * from cronograma where email='$usuario'";

														 $resultado2= pg_query($conecta, $sql2);
														  $qtde2=pg_num_rows($resultado2);
														 if ($qtde2 >= $subunidadestot)
														 {
														 ?>
															 <center><h5>Parabéns, você concluiu o curso!</h5>
															 <a href="#">PDF de questões intensivo</a>&nbsp;&nbsp;&nbsp;&nbsp;
														  <a href="noticias.php">Ler notícias</a></center><br>
														  
														  <?php

														 }
														 

															$usuario =  $linha2['email']; 

													
														$sqlzinho="select max(id_cronograma) from cronograma where email='$usuario'";
															$resuttt= pg_query($conecta, $sqlzinho);
														 $qta=pg_num_rows($resuttt);
													 
														 if ($qta > 0)
														 {

															 $linhazinha=pg_fetch_array($resuttt);
															 $ultimasub=$linhazinha[0];
														
														 }
														 
														 
														$sqlcont="SELECT subunidade.subunidade, subunidade.id_subunidade, cronograma.id_subunidade from subunidade inner join cronograma on subunidade.id_subunidade=cronograma.id_subunidade and cronograma.id_cronograma='$ultimasub'";

														 $resultadocont= pg_query($conecta, $sqlcont);
														 $qtdea=pg_num_rows($resultadocont);
														 if ($qtdea > 0)
														 {

															 $linhaa=pg_fetch_array($resultadocont);
															 ?>
															 <center>Você parou em <?php echo $linhaa['subunidade']?><br>
														  <a href="paggeralcont.php">Retomar estudos</a></center><br>
														 <?php

														 }
														 ?>
											  
											 </div>

											</div>

									<div class='form-group col-md-3 col-xs-5 col-md-offset-1 '>
										<div id="estadousuario" class="grow">

											 <br>
											 <center> <a href="questoes.php">Resolver questões diversas</a></center><br><br>
											  
										</div>


									</div>
									</center>
										</div>

										<div class="row"><br><br>
											<div class='form-group col-md-7 col-xs-10 col-md-offset-3 col-xs-offset-1'>
												
											<?php
												//Precisa da página da Bianca e do Weslley para funfa
												if($dificuldadecurso=='intensivo'){
													$sqlsub="select id_subunidade from subunidade where excluido='n'";
												}
												else{
													$sqlsub="select id_subunidade from subunidade where lower(dificuldade)='$dificuldadecurso' and excluido='n'";
												}

												$resultadosub= pg_query($conecta, $sqlsub);
												$qtdesub=pg_num_rows($resultadosub);
												
												$subunidadestot=$qtdesub;
												//arrumar a cagada de baixo
												
												$sqlbarra="select * from cronograma where email='$usuario'";
												 $resultadobarra= pg_query($conecta, $sqlbarra);
												 $qtdebarra=pg_num_rows($resultadobarra);
												 if ($qtdebarra > 0)
												{
													
													 $linhabarra=pg_fetch_array($resultadobarra);
													 $subqueta=$linhabarra['id_subunidade'];
													$progresso=(($qtdebarra*100)/$subunidadestot);
													

												if(intval($progresso) < 50)
												{
													?>
												<h4>Progresso do curso SoftBio:</h4><br>
												<div class="progress">
												  <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="<?=$progresso?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo intval($progresso);?>%">
													<b><?php echo intval($progresso);?>%</b>
												  </div>
												</div>
												<?php
												}

												else{
												?>
												<h4>Progresso do curso SoftBio:</h4><br>
												<div class="progress">
												  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?=$progresso?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo intval($progresso);?>%">
													<b><?php echo intval($progresso);?>%</b>
												  </div>
												</div>
													 <?php
												}
												
												
												$sqlbarra1="select * from cronograma where email='$usuario'";


												 $resultadobarra1= pg_query($conecta, $sqlbarra1);
												 $qtdebarra1=pg_num_rows($resultadobarra1);
												 if ($qtdebarra1 ==$subunidadestot)
												 {


												?>
												<h4>Progresso do curso SoftBio:</h4> 
												 Parabéns <?php echo $linha2["nome"];?>! <span class="glyphicon glyphicon-star-empty" ></span>
												<br>
													Desejamos que seus objetivos com a realização do curso SofBio sejam alcançados!<br><br>

												<div class="progress">
												  <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
													<b>100%</b><br>
												  </div>
												</div>
													 <?php
												}
												
												}

												
												

												$sqlbarra2="select * from cronograma where email='$usuario'";


												 $resultadobarra2= pg_query($conecta, $sqlbarra2);
												 $qtdebarra2=pg_num_rows($resultadobarra2);
												 if ($qtdebarra2 <= 0)
												 {

												?>
												<h4>Você ainda não principiou seus estudos.</h4>
													 <a href="paggeralcont.php">Iniciar agora</a> <br><br>


												<div class="progress">
												  <div class="progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
													
												  </div>
												  <b>0%</b>
												</div>
													 <?php
												}

												?>


											</div>
										</div>
							</div>
					</div>
		
		</form>
			<footer id="footer" class="footer">
				</footer>
 </body>
  	
</html>
