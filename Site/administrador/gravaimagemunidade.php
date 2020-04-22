<?php 
session_start();
include "../conecta.php";
include "hashimagem.php";
 $tabela=$_POST['tabela'];


 $id=$_POST['id'];

 $type="image/png,image/jpeg,image/jpg";

if($_POST["gif"] && $_POST["gif"]=="s")
  $type.=",image/gif";
else
  $gif="n";

/*if($_POST['nome'])
   $nome=$_POST['nome'];
else
   $nome=$_POST['tabela'];
*/

$nome=retornaHash();
if($_POST['pasta'])
   $pasta=$_POST['pasta'];
else
   $pasta="/hope/tcc/img";


if($id=="")
{
	$sql="select max(id_$tabela) from $tabela";
$resultado=pg_query($conecta,$sql);
$linha = pg_fetch_array($resultado1);
$id=$linha[0];
}



if($tabela=="questao")
	$nome=$nome.$id;


$uploadOk = 1;

 $nome_inicial= basename($_FILES["arquivo"]["name"]);

 $imagem_type = pathinfo($nome_inicial,PATHINFO_EXTENSION);
 $nome_final= $pasta.$nome.".".$imagem_type;

 $nome_apagar= $pasta.$nome.".";



//TAMANHO IMG UNI




//TAMANHO IMG curiosidades

if($tabela=="curiosidades")
{
	

$EndImagem = $nome_final; //Endereço da imagem. Pode ser também uma URL

//Pegando as informações da imagem
$TamanhoImagem = getimagesize($EndImagem);
//$TamanhoImagem[0];
echo "<br>".$TamanhoImagem[1];

	if ($TamanhoImagem[0] != $TamanhoImagem[1] )
	{
		//echo "<script>alert('A largura e altura da imagem devem ser iguais!'); close();   </script>";
		header("Location: cadastrarimgcuriosidade.php"); 

		
	}
	
	/*if ($TamanhoImagem[0] != $TamanhoImagem[1] || $TamanhoImagem[0] >150 || $TamanhoImagem[0] <140 || $TamanhoImagem[1] >150 || $TamanhoImagem[1] <140)
	{
		//echo "<script>alert('A largura e altura da imagem devem ser iguais!'); close();   </script>";
		header("Location: cadastrarimgcuriosidade.php"); 

		
	}*/
	/*else if ($TamanhoImagem[0] >150 || $TamanhoImagem[0] <140)
	{

	
		header("Location: cadastrarimgcuriosidade.php"); 

	}
	else if($TamanhoImagem[1] >150 || $TamanhoImagem[1] <140)
	{
		header("Location: cadastrarimgcuriosidade.php"); 
		$estado=1;
	}*/

}


// Testa se já existe o arquivo e apaga os antigos
if (file_exists($nome_final)) {
	unlink($nome_final);
	header($_SERVER['PHP_SELF']);
}


// Check file size
if ($_FILES["arquivo"]["size"] > 512000)//500kb de limite
 {
    $uploadOk = 0;
    echo "<script>alert('A imagem excede o limite de 500KB, tente escolher outra ou então reduzi-la');
    close();
    </script>";
	
	return;

}
// Allow certain file formats
if($imagem_type != "jpg" && $imagem_type != "png" && $imagem_type != "jpeg" && ($imagem_type == "gif" && $gif!="s") && $imagem_type != "gif" ) {

    $uploadOk = 0;
    echo "<script>alert('Desculpe, mas esse formato não é permitido! Tente utilizar os formatos sugeridos.');
    close();
    </script>";
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$enviado="n";
    echo "<script>alert('Desculpe, não foi possível cadastrar a imagem.Tente novamente');
    close();
    </script>";
// if everything is ok, try to upload file
} 
else
{
if(move_uploaded_file($_FILES["arquivo"]["tmp_name"], $nome_final))
{
	$enviado="s";
      echo "<script>   close();   </script>";
    } 
    else {
    	$enviado="n";
        echo "<script>alert('Desculpe, não foi possível cadastrar a imagem.Tente novamente!');
        alert('".$_FILES['userfile']['error']."');
    close();
    </script>";
    }
}

if($enviado="s")
{
	$nome_aqui=$nome.".png";
$sql="update $tabela set imagem='$nome_aqui' where id_$tabela = $id";
$resultado=pg_query($conecta,$sql);
$linhas=pg_affected_rows($resultado);
}
else
{
$linhas=-10;
}

 if($linhas<=0)
{
   echo "<script>alert('Desculpe, tivemos um problema com o Banco de Dados. Tente Mais Tarde'); close();   </script>";
}
 else//inseriu no banco e servidor
    {
		
			//TAMANHO IMG UNI
				if($tabela=="unidade")
				{
					$certo=1;
					echo $certo;
					$_SESSION["certo"]=$certo;
					$EndImagem = $nome_final; //Endereço da imagem. Pode ser também uma URL
					//Pegando as informações da imagem
					$TamanhoImagem = getimagesize($EndImagem);
				
					
					//$TamanhoImagem[0];
					//echo "<br>1: ".$TamanhoImagem[0];
					//echo "<br>2: ".$TamanhoImagem[1];
					if ($TamanhoImagem[0] != $TamanhoImagem[1])
					{	
						$_SESSION["vez"]=2;				
						$certo=2;
						$_SESSION["certo"]=$certo;
						$sql1="update $tabela
						   set
						   imagem=NULL
						   where id_$tabela = $id";

						$resultado1=pg_query($conecta,$sql1);
						$linhas1=pg_affected_rows($resultado1);
						if($linhas1>0)
						{
							unlink("../img/unidade/".$id.".png");//TIRA DO SERVIDOR
							header("Location: cadastrarimagemuni.php"); 
						}
						else 
						{
								header("Location: cadastrarimagemuni.php");
						}
						
						 header("Location: cadastrarimagemuni.php");
						
					}
					if ($TamanhoImagem[0] >64 ||  $TamanhoImagem[1] >64)
					{
						 $_SESSION["vez"]=2;
						$certo=0;
						$_SESSION["certo"]=$certo;
						$sql2="update $tabela
						   set
						   imagem=NULL
						   where id_$tabela = $id";

						$resultado2=pg_query($conecta,$sql2);
						$linhas2=pg_affected_rows($resultado2);
						if($linhas2>0)
						{
							
							unlink("../img/unidade/".$id.".png");//TIRA DO SERVIDOR
							//header("Location: cadastrarimagemuni.php"); 
						}
						else 
						{
								header("Location: cadastrarimagemuni.php");
						}
						 echo "<script>alert('O tamanho excede 64 pixels');    </script>";
						 header("Location: cadastrarimagemuni.php");
					}
					if ($TamanhoImagem[0] == $TamanhoImagem[1] && $TamanhoImagem[0] <=64 &&  $TamanhoImagem[1] <=64)
					{
						 $_SESSION["vez"]=1;
						$certo=1;
						$_SESSION["certo"]=$certo;
						if ($_SESSION["imguni"]==0)
						{
							header("Location: cadastrounidadeadm.php");
						}
						else 
						{
							$_SESSION["idaqui"]=1;
							$_SESSION["valorid"]=$id;
							
							header("Location: submenualteraunidade.php");
						}
					}
					

				}
				else 
				{

				header("Location: index.php");
				}
				
				//header("Location: index.php");
            }



?>



