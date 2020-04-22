<?php
include "conexao.php";
include "substituir.php";
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$acao=$_POST['acao'];
	$id = $_POST['id_noticia'];
	$texto=$_POST['texto'];
	$data=$_POST['data'];
	$fonte=$_POST['fonte'];
	$titulo=$_POST['titulo'];
	
	$texto_pronto = textobanco($texto);
	$fonte_pronto = textobanco($fonte);
	$titulo_pronto = textobanco($titulo);
	
	
	if($acao=='update'){
		$sql="update noticia set data='".$data."', texto='".$texto_pronto."', fonte='".$fonte_pronto."', titulo='".$titulo_pronto."' where id_noticia=".$id."";	
		$resultado=pg_query($conecta,$sql);
		$linhas=pg_affected_rows($resultado);
		
		if ($linhas > 0){
			echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
			$_SESSION['id_noticia'] = $id;
			header("location: alteraimagemnoticia.php");
		}
		else{
			echo "<script type='text/javascript'>alert('Erro na alteração!')</script>";
			header("location:./editarnoticia.php");
		}
	}
	
	if ($acao == 'restaurar'){
		$sql="update noticia set excluido='n' where id_noticia=$id";
		$resultado=pg_query($conecta,$sql);
		$linhas=pg_affected_rows($resultado);
		//header("location:./listanoticias.php");
	}
	
	if($acao=='delete'){
		/* deleta 
		
		:
		if (file_exists($imagem)) {
			unlink($imagem);
		}
		*/
		
		$data = date("Y-m-d");
		$sql="update noticia set excluido='s', dataexclusao='$data' where id_noticia=$id";
		$resultado=pg_query($conecta,$sql);
		$linhas=pg_affected_rows($resultado);
		
		if ($linhas > 0){
			echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
			header("location: listanoticias.php");
		}
		else{
			echo "<script type='text/javascript'>alert('Erro na alteração!')</script>";
			header("location:./editarnoticia.php");
		}
	}
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
	
	<title>Softbio - Cadastro de notícias</title>
	
	<link rel="icon" href="./img/iconesub/sb.ico">
	
	<script src="../bootstrap/jquery.js"></script>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/cadastronoticias.css"/>
	<link rel="stylesheet" href="../css/apendices.css"/>
	<script src="bootstrap/jquery.js"></script>
	
	<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.8.3.min.js" charset="UTF-8"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8" media="screen"></script>
	<script type="text/javascript" src="../js/bootstrap-datetimepicker.pt-BR.js" charset="UTF-8" media="screen"></script>
	
	<script> 
		$(function(){
			$("#footer").load("footer.html"); 
			$("#navbar").load("../navbar.php?p=adm");
		});

	</script> 
	
</head>

<div id="navbar">
</div>


<body>
	<div class="container-fluid contentpagina">
		<center>
			<h1>Edição e Exclusão de Notícias<br>
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
		if($_POST['id_noticia']!='')
			$sql="Select * From noticia where id_noticia=".$_POST['id_noticia'];
		else if($_SESSION['id_noticia']!='')
			$sql="Select * From noticia where id_noticia=".$_SESSION['id_noticia'];
		//}
		$resultado= pg_query($conecta, $sql);
		$qtde=pg_num_rows($resultado);
		if ($qtde > 0)
		{
			$linha=pg_fetch_array($resultado);
			$titulo = $linha['titulo'];
			$texto_input = textoinput2($linha['texto']);
			$fonte_input = textoinput2($linha['fonte']);
			$excluida = $linha['excluido'];
			
			$data_numero = $linha['data'];
			
			$ano = substr($data_numero, 0, 4);
			$mes = substr($data_numero, 5, 2);
			$dia = substr($data_numero, 8, 2);
			
			$data_numero = $dia . "-" . $mes . "-" . $ano;
			
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
			
			<form action="verifnoticia.php" method="post">
				<div class="row">
					<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
						
						<label for="titulo" class="control-label"><h3>Título</h3></label>
						<input id="titulo" class="form-control" placeholder="Título da notícia"  name="titulo" maxlength="150" type="text" 
						value="<?php echo $titulo ?>" <?php if($excluida == 's'){echo 'readonly';} ?> required>

					</article>
					<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
						
						<label for="texto" class="control-label"><h3></h3></label>
						<textarea id="texto" class="form-control" name="texto" required rows="15" cols="70" style="resize: none;" <?php if($excluida == 's'){echo 'readonly';} ?>><?php echo $texto_input ?></textarea>
					</article>
					
					<div class="form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1">
						<h3>Data</h3>
						<?php if($excluida == 'n'){?>
						<div  class="input-group date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="data" data-link-format="dd-mm-yyyy">
							<input class="form-control"  type="text" readonly name="data_texto" id="data_texto"  value="<?php echo $data_texto; ?>">
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<input type="hidden" id="data" name="data" value="<?php echo $data_numero ?>" required>
						<?php }else{ ?>
						<div  class="input-group date " data-date="" data-date-format="dd MM yyyy" >
							<input type="text" id="data" class="form-control" name="data" value="<?php echo $data_texto ?>" readonly>
							<span class="input-group-addon" readonly><span class="glyphicon glyphicon-calendar" readonly></span></span>
						</div>
						<input type="hidden" id="data" name="data" value="<?php echo $data_numero ?>">
						<?php } ?>
					</div>
					
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
					
					
					<article class='form-group col-md-4 col-xs-10 col-md-offset-4 col-xs-offset-1'>
						
						<label for="fonte" class="control-label"><h3>Fonte</h3></label>
						<input id="fonte" class="form-control" placeholder="Fonte"  name="fonte" 
						value="<?php echo $fonte_input ?>" <?php if($excluida == 's'){echo 'readonly';} ?> required>
						
					</article>
					
				</div><!--row-->
				<div class="row">
					<div class='form-group col-md-12 col-xs-12'>
						<input type='hidden' name='id_noticia' id='id_noticia' value="<?php echo $linha['id_noticia']; ?>"></input>
						<?php
						if($excluida=='n'){
							?>
							<center>
								<input type='hidden' name='pagina' id='pagina' value="edita"></input>
								<button type="submit" class="btn btn-primary" id="acao" name="acao" value="update">Salvar Notícia</button>
								<button type="submit" class="btn btn-primary" id="acao" name="acao" value="delete" onClick="return confirm('Deseja realmente excluir a notícia?');">Excluir Notícia</button></center>
								<?php
							}
							else if($excluida == 's'){
								?>
								<center>
									<input type='hidden' name='pagina' id='pagina' value="edita"></input>
									<button type="submit" class="btn btn-primary" id="acao" name="acao" value="restaurar">Restaurar Notícia</button>
								</center>
								<?php
							}
							?>
					</div>

				</div>
			</form>
				<?php
			}
			else{
				echo "Notícia não encontrada!";
			}
			pg_close($conecta); 
			?>
	</div>
		<div id="footer" class="footer">
		</div>
	</body>


	
	</html>
