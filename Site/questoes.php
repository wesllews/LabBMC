<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="img/iconesub/sb.ico">

	<title>Softbio - Questões</title>
	<link rel="icon" href="img/logos/sb.ico">

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/home.css">
	<link rel="stylesheet" type="text/css" href="css/questoes.css">
  	<script src="bootstrap/jquery.js"></script>

    <script> 
    $(function(){
      $("#footer").load("footer.html"); 
	  	$("#navbar").load("navbar.php?p=questoes");
    });

	$(document).ready(function(){
	  $("#filtro").hide();
	  $("#hide").hide();

	$("#hide").click(function(){
	  $("#filtro").hide(400);
	  $("#hide").hide();
	  $("#pdf").show(400);
	  $("#show").show();
	    });
    $("#show").click(function(){
      $("#filtro").show(400);
      $("#hide").show();
      $("#pdf").hide(400);
      $("#show").hide();
    });
});

function check(x){ 
 document.getElementById(x).checked = true;}
</script> 
	<style>
.bs-callout { padding: 20px;margin: 20px 0;border: 1px solid #eee; border-left-width: 5px;border-radius: 3px;}
.bs-callout h4 { margin-top: 0;  margin-bottom: 5px;}
.bs-callout p:last-child {    margin-bottom: 0;}
.bs-callout code {    border-radius: 3px;}
.bs-callout+.bs-callout {    margin-top: -5px;}
.bs-callout-success {    border-left-color: #5cb85c;}
.bs-callout-success h4 {    color: #5cb85c;}
.bs-callout-danger {    border-left-color: #d9534f;}
.bs-callout-danger h4 {    color: #d9534f;}
.bs-callout-warning {    border-left-color: #f0ad4e;}
.bs-callout-warning h4 {    color: #f0ad4e;}
	</style>
</head>


<div id="navbar"></div>

<body>
<div class="contentpagina"><br>

<div class="container-fluid" > 

<?php
session_start();

	if (!isset($_SESSION["logou"]))
	{
		$_SESSION['pagina_antes_login'] = 'questoes.php';
		header("Location: login.php");
	}
	$email=$_SESSION['usuario'];

$_SESSION['subunidade']=$_POST['subunidade'];
include "conecta.php";
include "substituir.php";


function Porcentagem(){
include "conecta.php";


$executa= pg_query($conecta,$_SESSION['questao_sql']);
$qtde=pg_num_rows($executa);
	if ($qtde>0) //testa se encontrou alguma questão no banco
	{ 
	$numero=0;//inicia numeração
		$acertos=0;
		$erros=0;
		while($linha=pg_fetch_array($executa))
		{
            $numero++; $resposta_Questao=strtolower($linha["resposta"]);	$id_questao=$linha['id_questao'];	$resposta_Aluno=$_POST[$id_questao];
		foreach(range('a','e') as $alternativa)
          {//Roda $linha entre as colunas de alternativa do banco

            if ($linha[$alternativa] !="")
            { //Insere a alternativa

            	if ($_POST['respondido']=='s') {
            		if($resposta_Aluno == $resposta_Questao && $resposta_Questao == $alternativa )
						$acertos++;
	              	else if($resposta_Aluno != $resposta_Questao && $resposta_Aluno == $alternativa )
						$erros++;
				}
			}
		  }
		}
	}
	$PercentErros = round($erros/$numero,1)*100;
	$PercentAcertos = round($acertos/$numero,1)*100;
	if($PercentAcertos==0){
		$Mensagem="Erroooooooou!";
	$Texto="Talvez seja necessário estudar mais um pouco mais!";
	$Cor="danger";
	}
	else if($PercentAcertos<=40){
		$Mensagem="Você pode mais!";
	$Texto="Relembre a matéria e tente de novo";
	$Cor="danger";
	}
	else if($PercentAcertos<=60 && $PercentAcertos>40 ){
		$Mensagem="Nada mal!";
	$Texto="Quem sabe um pouco mais de atenção?!";
	$Cor="warning";
	}
	else if($PercentAcertos<=80 && $PercentAcertos>60){
		$Mensagem="Muito Bem!";
	$Texto="Quem sabe um pouco mais de atenção?!";
	$Cor="success";}
	else if($PercentAcertos>80){
		$Mensagem="Genial";
	$Texto="Mandou bem, você está de PARABÉNS!";
	$Cor="success";}
	
?>
<div class="pull-right col-lg-4 col-md-4 col-sm-12 col-xs-12 group-vertical " role="group" aria-label="...">
<h3>Acertos</h3>
	<div class="progress">
		<div class="progress-bar  progress-bar-striped progress-bar-animated progress-bar-success" role="progressbar" 
		style="width:<?php echo $PercentAcertos;?>%" aria-valuenow="<?php echo $PercentAcertos;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $PercentAcertos."%";?></div>
	</div>
<h3>Erros</h3>
	<div class="progress">
		<div class="progress-bar  progress-bar-striped progress-bar-animated progress-bar-danger" role="progressbar" 
		style="width:<?php echo $PercentErros;?>%" aria-valuenow="<?php echo $PercentErros;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $PercentErros."%";?></div>
	</div>
		
<div class="bs-callout bs-callout-<?php echo $Cor;?>">
  <h4><?php echo $Mensagem;?></h4>
  <?php echo $Texto;?>
</div>
	
</div>
<?php
}	


function Combo($questao_sql,$limite,$subunidade,$peso,$universidade,$ano){
include "conecta.php";
?>
<div class="pull-right col-lg-4 col-md-4 col-sm-12 col-xs-12 group-vertical " role="group" aria-label="...">
<form action="pdfquestao.php" method="POST">

	<input type="submit" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right btn btn-success alert alert-success text-center" value ="Gerar PDF">
	</form>
	
  <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right btn btn-success alert text-center" type="button"
  id="hide" value="Busca avancada"/>

  <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right btn btn-success alert alert-success text-center" type="button"
  id="show" value="Busca avancada"/>
  
<form class='col-lg-12 col-md-12  col-sm-12 col-xs-12 pull-right ' id='filtro' action='questoes.php' method='post'>
<?php
$universidade_sql=" SELECT distinct(questao.id_universidade),universidade.nome,universidade.sigla FROM questao JOIN subunidade ON (questao.id_subunidade=subunidade.id_subunidade) 
JOIN unidade ON (subunidade.id_unidade=unidade.id_unidade) JOIN frente ON (unidade.id_frente=frente.id_frente) JOIN universidade ON (universidade.id_universidade=questao.id_universidade)
where questao.excluido='n' $subunidade $peso $ano order by sigla";

$executauniversidade= pg_query($conecta,$universidade_sql);
$qtdeuniversidade=pg_num_rows($executauniversidade);
  
if ($qtdeuniversidade > 0) //testa se encontrou alguma universidade                                
 {?>
	<h5>Universidade:</h5>
	<select name='universidade' class='form-control'>
	 <option selected disabled>Universidades</option>
<?php
    while($linhauniversidade=pg_fetch_array($executauniversidade))
     { 
				if($_POST['universidade']==$linhauniversidade['id_universidade'])
					{   ?>
            <option SELECTED value='<?php echo $linhauniversidade['id_universidade'];?>'>
            <?php echo $linhauniversidade['sigla'];?> - <?php echo $linhauniversidade['nome'];?></option>
          <?php
          }          
				else
					 {   ?>
            <option value='<?php echo $linhauniversidade['id_universidade'];?>'>
            <?php echo $linhauniversidade['sigla'];?> - <?php echo $linhauniversidade['nome'];?></option>
          <?php
          }
			}              
        ?><select> <!--Fecha Universidades--><?php
}
 else
   	{	?>
   		<h5>Universidade:</h5>
   		<select name='universidade' class='form-control' disabled>
    	<option selected disabled>Sem Correspondencia</option> 
    	</select>
      <?php
    }

///////////////////////////////////////////
$peso_sql=" SELECT distinct(peso) FROM questao JOIN subunidade ON (questao.id_subunidade=subunidade.id_subunidade) JOIN unidade ON (subunidade.id_unidade=unidade.id_unidade)
JOIN frente ON (unidade.id_frente=frente.id_frente) JOIN universidade ON (universidade.id_universidade=questao.id_universidade) where questao.excluido='n' $frente $unidade $subunidade $universidade $ano order by peso asc";
  $executapeso= pg_query($conecta,$peso_sql);
  $qtdepeso=pg_num_rows($executapeso);
  
  if ($qtdepeso > 0) //testa se encontrou alguma peso
      {?>
      	<h5>Dificuldade:</h5>
      	<select name='peso' class='form-control'>
      	<option selected disabled>Dificuldade</option>
<?php
      while($linhapeso=pg_fetch_array($executapeso))
        { 
  				if($_POST['peso']==$linhapeso['peso'])
            {   ?>
              <option SELECTED value='<?php echo $linhapeso['peso'];?>'>
              <?php echo $linhapeso['peso'];?></option>
            <?php
            }     
  				else
  					{   ?>
              <option  value='<?php echo $linhapeso['peso'];?>'>
              <?php echo $linhapeso['peso'];?></option>
            <?php
            } 
      	}
        ?><select> <!--Fecha pesos--><?php
    }
    else
  	{	?>
      <h5>Dificuldade:</h5>
   		<select name='peso' class='form-control' disabled>
    	<option selected disabled>Sem Correspondencia</option> 
    	</select>
      <?php
    }
///////////////////////////////////////////
$ano_sql="SELECT distinct(data) FROM questao JOIN subunidade ON (questao.id_subunidade=subunidade.id_subunidade) JOIN unidade ON (subunidade.id_unidade=unidade.id_unidade)
JOIN frente ON (unidade.id_frente=frente.id_frente) JOIN universidade ON (universidade.id_universidade=questao.id_universidade) where questao.excluido='n' $frente $unidade $subunidade $universidade $peso order by data ";
  $executaano= pg_query($conecta,$ano_sql);
  $qtdeano=pg_num_rows($executaano);
    
  if ($qtdeano > 0) //testa se encontrou alguma ano
      { ?>  
	  <h5>Ano:</h5>
      	<select  name='ano' class='form-control'>
        <option selected disabled>Ano</option>";
  <?php    
         while($linhaano=pg_fetch_array($executaano))
          { 
            if($_POST['ano']==$linhaano[0])
          			{  ?>
                  <option SELECTED value='<?php echo$linhaano[0];?>'>  <?php echo$linhaano[0];?>  </option>
                <?php 
                }
          		else
          			{  ?>
                    <option value='<?php echo$linhaano[0];?>'>  <?php echo$linhaano[0];?>  </option>
                  <?php
                }
          }
            
      ?><select> <!--Fecha Ano--><?php
    }
    else
  	{	
  		?>
      <h5>Ano:</h5>
  		<select name='ano' class='form-control' disabled>
    	   <option selected disabled>Sem Correspondencia</option> 
    	</select>
    <?php
    }
    ?>
<br>  	
<input type='hidden' name='subunidade' value='<?php echo $_POST['subunidade'];?>'>
<input type="hidden" name="frente" value="<?php echo $frente;?>">
<button type='submit' class=' form-control btn btn-success'>Pesquisar</button>
<br><br>
<div onclick="document.getElementById('limpa').submit();" class='form-control btn btn-success'>Limpar</div>
<br>
</div> </form>

<form action="questoes.php" method="post" id="limpa">
<input type="hidden" name="frente" value="<?php echo $frente;?>">
	<input type='hidden' name='subunidade' value='<?php echo $_POST['subunidade'];?>'>
</form>
<?php
}




////////////////////////////////////////////////////
/////////////////Filtro por opção///////////////////
////////////////////////////////////////////////////

if(isset($_POST['limite']))
$limite="limit ".$_POST['limite']." offset 0"; 

$subunidade="and  questao.id_subunidade=".$_SESSION['subunidade']; 

if($_POST['universidade']!="")
$universidade="and  questao.id_universidade=".$_POST['universidade'];

if($_POST['peso']!="")
	$peso="and  peso like '%".$_POST['peso']."%'";

if($_POST['ano']!="")
$ano="and data=".$_POST['ano'];




////////////////////////////////////////////////////
////////Design de escolha de Frente e Unidade///////
////////////////////////////////////////////////////   
include "conecta.php";

?>
	<div class="row">
        <div class="col-lg-12">
			<center><h1>Questões<br>
			<hr>
            </h1></center>
        </div>
    </div>
<?php
if(!$_POST['frente'])
$frente = $_SESSION['frente_questao'];
else
{
$frente=$_POST['frente'];
$_SESSION['frente_questao']=="";
}

if($frente=="" && !$_POST['subunidade'] && !$_POST['respondido']){
	$_SESSION['voltar_questoes']='nao';
	$frente_sql="SELECT * FROM frente order by id_frente";
  $executafrente= pg_query($conecta,$frente_sql);
  $qtdefrente=pg_num_rows($executafrente);

  while($linhafrente=pg_fetch_array($executafrente))
    {?>
<form method="post" action="questoes.php">
 <input type="hidden" name="frente" value="<?php echo $linhafrente['id_frente'];?>">
 <button type="submit" style="border: none;"class="quadradofrente">
     <h2><?php echo $linhafrente['frente'];?></h2>
     <h4><?php echo $linhafrente['descricao'];?></h4>
 </button>
  </form>
<?php	
	}//while frente
}//get Frente

if(!$_POST['subunidade'] && $_POST['respondido']!='s')	//mostra subunidades com os check-icon
{
	$unidade_sql="SELECT * FROM unidade where id_frente=".$frente." order by id_unidade";
    $executaunidade= pg_query($conecta,$unidade_sql);
    
           while($linhaunidade=pg_fetch_array($executaunidade)){
			   $_SESSION['voltar_questoes']='frente';
?>
<div  class="quadradounidade">
	<div class="unidade">
		 <h2><?php echo $linhaunidade['unidade'];?></h2>
	</div>

	<div class="subunidade">
	<?php 
		$subunidade_sql="SELECT * FROM subunidade where id_unidade=".$linhaunidade['id_unidade']." order by id_subunidade";
	        $executasubunidade= pg_query($conecta,$subunidade_sql);
            while($linhasubunidade=pg_fetch_array($executasubunidade)){
					?>
        <form method="post" action="questoes.php" id="<?php echo $linhasubunidade['subunidade'];?>">
	       
		   <input type="hidden" name="subunidade" value="<?php echo $linhasubunidade['id_subunidade'];?>">
	        <input type="hidden" name="frente" value="<?php echo $frente;?>">
			
	        <h3 class="subuni" onclick="document.getElementById('<?php echo $linhasubunidade['subunidade'];?>').submit();">
	        <span class="glyphicon glyphicon-check glyphicon-align-left" aria-hidden="true"></span>
	        <?php echo $linhasubunidade['subunidade'];?>
	        </h3>
	    </form>
					<?php					
				}//while subunidade
	?>
	</div>
</div>
<?php
		}//while unidade
}//get Frente - unidade
     
////////////////////////////////////////////////////
//////////Começa a escrever as perguntas////////////
//////////////////////////////////////////////////// 
if($_POST['id_questao']) 
 	$questao_sql="SELECT questao.imagem,* FROM questao where id_questao=".$_POST['id_questao'];

else if($_POST['subunidade'] && !$_POST['respondido'] )	
{
 $questao_sql="SELECT questao.imagem,* FROM questao 
JOIN subunidade ON (questao.id_subunidade=subunidade.id_subunidade) 
JOIN unidade ON (subunidade.id_unidade=unidade.id_unidade)
JOIN frente ON (unidade.id_frente=frente.id_frente)
JOIN universidade ON (universidade.id_universidade=questao.id_universidade)
where questao.excluido='n' $unidade $subunidade $universidade $peso $ano $limite ";
$_SESSION['questao_sql']=$questao_sql;
}
else if($_POST['respondido']=='s')
{
	$questao_sql=$_SESSION['questao_sql'];
}
else
{
	$questao_sql="";
	$_SESSION['questao_sql']=$questao_sql;
}


$executa= pg_query($conecta,$questao_sql);
$qtde=pg_num_rows($executa);
	if ($qtde>0) //testa se encontrou alguma questão no banco
	{
		if($_POST['respondido']!='s')
		{
			$_SESSION['voltar_questoes']='subunidade';
			Combo($questao_sql,$limite,$subunidade,$peso,$universidade,$ano);
		}
		if($_POST['respondido']=='s')
		{
			$_SESSION['voltar_questoes']='responder';
		Porcentagem();
		}
?>		
	<form action='questoes.php' method='POST' class='col-lg-8 col-md-8 col-sm-12 col-xs-12'>
	<input type="hidden" name="frente" value="<?php echo $frente;?>">
<?php
		$numero=0;//inicia numeração
		$acertos=0;
		$erros=0;
		while($linha=pg_fetch_array($executa))
		{
            $numero++;	$cor; $check; $icon; $alert; $onclick;   $resposta_Questao=strtolower($linha["resposta"]);	$id_questao=$linha['id_questao'];	$resposta_Aluno=$_POST[$id_questao];
?>
	<div class='panel panel-default'>
		<div class='panel-heading'>
	 	   <b>	<?php echo"$numero) </b>".textohtml2($linha["pergunta"]);
	 	   	?>
	 	 		<br>
			 	<img src="./img/questao/<?php echo $linha[0]; ?>.jpg" alt='Imagem não encontrada' class='img-responsive imagemquestao'>
	 	   <?php  ?>
	 	</div><!--heading-->
    <div class='panel-body'>
<?php     
          foreach(range('a','e') as $alternativa)
          {//Roda $linha entre as colunas de alternativa do banco

            if ($linha[$alternativa] !="")
            { //Insere a alternativa

            	if ($_POST['respondido']=='s') {
            		$onclick="";
            		if($resposta_Aluno == $resposta_Questao && $resposta_Questao == $alternativa )
	                  { 
						$acertos++;
	                  	$cor= "has-success";
	                  	$alert= "alert-success";
	                  	$icon= "<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>";
	                  	$check ="checked";  
	                  }

					else if($resposta_Aluno != $resposta_Questao && $resposta_Questao == $alternativa )
	                  { 
	                  	$cor= "has-success";
	                  	$alert= "alert-success";
	                  	$icon= "<span class='glyphicon glyphicon-ok form-control-feedback' aria-hidden='true'></span>";
	                  	$check ="";  
	                  }

	              	else if($resposta_Aluno != $resposta_Questao && $resposta_Aluno == $alternativa )
	                  { 
						$erros++;
	                  	$cor= "has-error";
	                  	$alert= "alert-danger";
	                  	$icon= "<span class='glyphicon glyphicon-remove form-control-feedback' aria-hidden='true'></span>";
	                  	$check ="checked";  
	                  } 

	                else
		              {
						$cor= "";
						$alert= "";
	                  	$icon= "";
	                  	$check ="";  
		              }       		
            	}//RESPONDIDO 'SIM'
            	else{
	                $cor= "";
	                $check ="";
	                $onclick="check('$id_questao$alternativa');";
            	}
              
             ?>
						<div class='input-group <?php echo $cor; ?>'>
					      <span class='input-group-addon <?php echo $cor; ?>'>

						        <input type='radio' 
								       id='<?php echo $id_questao.$alternativa;?>' 
								       name='<?php echo $id_questao;?>' 
								       value='<?php echo $alternativa;?>' 
								       <?php echo $check;?>
								        required >
					      </span>

					      <div class=" form-control perguntas input-group <?php echo $alert; ?> "  onclick="<?php echo $onclick; ?>" > <?php echo textohtml2($linha[$alternativa]);?> </div> <?php echo $icon; ?>
					 
						</div>
	       	 <?php
            
              }//ALTERNATIVA NÃO VAZIA
             if($_POST['respondido']=='s')
              echo "<script>  document.getElementById('".$id_questao.$alternativa."').disabled = true; </script>";
            }//Foreach  
			
        ?>
</div><!--body-->
</div><!--panel-->
<?php              
	}// if while-Linha Questões
	
?>
<input type='hidden' name='peso' value='<?php echo $_POST['peso']?>'>
<input type='hidden' name='ano' value='<?php echo $_POST['ano']?>'>
<input type='hidden' name='subunidade' value='<?php echo $_POST['subunidade'];?>'>
<input type='hidden' name='universidade' value='<?php echo $_POST['universidade'];?>'>
<input type="hidden" name="respondido" value="s">
<input type="hidden" name="id_questao" value="<?php echo $_POST['id_questao'];?>">
<?php
		if(!$_POST['respondido'])
		{		?>
		    <input class="col-lg-12 col-md-12 col-sm-12 col-xs-12 btn btn-success alert alert-success text-center" type="submit" class="responde" value="Responder">
		  </form>  
		<?php	}//!Respondido
		else
		{		?>
	
	<a href="pdfquestao.php" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pull-right btn btn-success alert alert-success text-center">Gerar PDF</a>
			<?php	}

}// if Qtde Questões
else if($qtde<=0 && $questao_sql!=""){
	?>
	<div class="jumbotron">
  <h1>Nenhuma questão encontrada</h1>
  <p>Tente refazer a busca, nós temos muito ainda a oferecer!</p>
  <p><a href="questoes.php" class="btn btn-success btn-lg" href="#" role="button">Voltar para o início</a></p>
</div>
	
	<?php
}
?>

</div>


<?php 
if ($_SESSION['frente_questao']!="" )
{
	$_SESSION['frente_questao']="";
echo '
<div class="row ">
<hr>	
<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="questoes.php" class="btn btn-primary">Voltar</a> </center>
	<br>
</div>';
}
else if ($_SESSION['voltar_questoes']!='nao' && $_SESSION['voltar_questoes']!='responder')
{
	echo'
	<div class="row ">
	<hr>
	<form action="questoes.php" method="post" id="voltar">
	<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<button type="submit" class="btn btn-primary">Voltar</button> </center>
	<br>
	';
	if($_SESSION['voltar_questoes']!='frente' )
	{
		echo "<input type='hidden' name='frente' value='".$frente."'>";
		if($_SESSION['voltar_questoes']!='subunidade')
		{
		echo "<input type='hidden' name='subunidade' value='".$_POST['subunidade']."'>";
			
		}//NOT SUBUNIDADE
	
	}//NOT FRENTE
	
	echo "</form>
	</div>";
}
else if ($_SESSION['voltar_questoes']!='nao' )
{
	$_SESSION['frente_questao']=$frente;
echo '
<div class="row ">
<hr>	
<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="questoes.php" class="btn btn-primary">Voltar ao início</a> </center>
	<br>
	</div>';
}

?>
		<footer id="footer" class="footer">
	</footer>
 </body>
  </html>
