<?php

session_start();
include "substituir.php";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Softbio - Cadastro de notícias</title>
	
	<link rel="icon" href="../img/logos/sb.ico">
	
	<script  type="text/javascript" src="../bootstrap/jquery.js"></script>
	<script  type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<link type="text/css" href="../css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" type="text/css" href="../css/cadastronoticias.css"/>
	<link type="text/css" rel="stylesheet" href="../css/apendices.css"/>
	
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8" media="screen"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8" media="screen"></script>
	
	
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
	
	
	$("#form").validate(function(){
		if($("#titulo").val()== null || $("#titulo").val() ==" " || $("#texto").val()== null || $("#texto").val() =="" || $("#data_texto").val()== null || $("#data_texto").val() =="" || $("#fonte").val()== null || $("#fonte").val() ==""){
			alert('Preencha todos os campos!');      
			return false;
		}
	});

	</script>
</head>

	<div id="navbar">
	</div>
	
	
<body>

	 <?php
		include "conexao.php";
		
		 session_start();
		 
		 $correto=$_SESSION['correto'];
	$_SESSION['correto']=null;
	
	
		 
		 $_SESSION["id"]=null;
		
		 
		//$email= $_GET["email"];
		$_SESSION['email']=$email;
		
		$_SESSION['noticia_texto'];
		$_SESSION['noticia_titulo'];
		$_SESSION['noticia_fonte'];
		$_SESSION['noticia_data'];
		
		
?>

	<div class="container-fluid contentpagina" style="margin-bottom: 110px;">
		
		<center>
			<h1>Cadastro de Notícias<br>
            <small>É obrigatório o preenchimento de todos os campos.</small>
			<hr>
			</h1>
		</center>
	 
		<?php if(isset($_SESSION['noticia_problema'])){?>
		<center>
			<div class="alert alert-danger" style="width: 32%; height: 60px; font-size: 20px;">
			<?php if($_SESSION['noticia_problema']=='texto_branco'){?>
				Por favor, cadastre os dados corretamente.
			<?php }else{?>
				Já existe uma notícia com esse <?php echo $_SESSION['noticia_problema']?>! 
			<?php } ?>
			</div>
		</center>
			<?php
			unset($_SESSION['noticia_problema']);
			unset($_SESSION['id_noticia_problema']);
		}// if $_SESSION['noticia_problema']
		
		//data formato dd-mm-yyyy:
			$data_numero = $_SESSION['noticia_data'];
			
			//transformando para dd <mês> yyyy:
			$dia = substr($data_numero, 0, 2);
			$mes = substr($data_numero, 3, 2);
			$ano = substr($data_numero, 6, 4);
			
			switch ($mes) {
				case '01':
					$mes = "Janeiro";
					break;
				case '02':
					$mes = "Fevereiro";
					break;
				case '03':
					$mes = "Março";
					break;
				case '04':
					$mes = "Abril";
					break;
				case '05':
					$mes = "Maio";
					break;
				case '06':
					$mes = "Junho";
					break;
				case '07':
					$mes = "Julho";
					break;
				case '08':
					$mes = "Agosto";
					break;
				case '09':
					$mes = "Setembro";
					break;
				case '10':
					$mes = "Outubro";
					break;
				case '11':
					$mes = "Novembro";
					break;
				case '12':
					$mes = "Dezembro";
					break;
					
			}
			
			$data_texto = $dia.' '.$mes.' '.$ano;
		?>
	<form action="verifnoticia.php" method="post" onsubmit="tiraVerificacao()" id="form">
	<div class="row">
	
		<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
				
				<input type="hidden" name="id_noticia" id="id_noticia" value="">
				
		
				<label for="titulo" class="control-label"><h3>Título</h3></label>
				<input id="titulo" class="form-control" placeholder="Título da notícia"  name="titulo" maxlength="150" type="text" 
				value="<?php echo $_SESSION['noticia_titulo'] ?>" required>
				  
		</article>
		<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1' >
							   
				<label for="texto" class="control-label"><h3>Texto</h3></label>
				<textarea id="texto" class="form-control" placeholder="Texto" name="texto" rows="15" cols="70" style="resize: none;" 
				required><?php echo $_SESSION['noticia_texto'] ?></textarea>  
				  
		</article>
		
		<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">
                <h3>Data</h3> 
                <div  class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="data" data-link-format="dd-mm-yyyy">
                    <input class="form-control"  type="text" readonly name="data_texto" id="data_texto"  value="<?php echo $data_texto; ?>" >
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="data" name="data" value="<?php echo $_SESSION['noticia_data'] ?>" required>
		</div>
		
		<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
							   
				<label for="fonte" class="control-label"><h3>Fonte</h3></label>
				<input id="fonte" class="form-control" placeholder="Fonte"  name="fonte" value="<?php echo $_SESSION['noticia_fonte'] ?>"required>
				  
		</article>
		<article>

			<script>
			$('.form_date').datetimepicker({
				language:  'pt-BR',
				weekStart: 1,
				startDate: '01-01-2000',
				endDate: '+0d',
				todayBtn:  1,
				autoclose: 1,
				todayHighlight: 1,
				startView: 2,
				minView: 2,
				forceParse: 0
			});
			</script>	
			</article>
				
	</div>
	
		<input type="hidden" name="pagina" id="pagina" value="cadastra">
		<input type="hidden" name="acao" id="acao" value="incluir">
	<div class="row">
	<center>
		<div class='form-group col-md-1 col-xs-1 col-md-offset-5 col-xs-offset-5'>
			<button type="reset" class="btn btn-primary" >Limpar</button>
		</div>
		<div class='form-group col-md-1 col-xs-1'>
			<button type="submit" class="btn btn-primary" >Enviar</button>
		</div>
	</center>
			<?php
			if(isset($_SESSION['noticia_problema'])){
				unset($_SESSION['noticia_titulo']);
				unset($_SESSION['noticia_problema']);
				unset($_SESSION['noticia_texto']);
				unset($_SESSION['noticia_data']);
				unset($_SESSION['noticia_fonte']);
			}
			?>
	
	</div>
	</div><!--row-->
	
	</form>	
   

	<footer id="footer" class="footer">
	</footer>
 </body>
	
</html>
