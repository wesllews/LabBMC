<html language="pt-br">
	<head>
	<meta charset="utf-8">
	</head>
	<?php 
	include "../conecta.php";
	session_start();
	
	function anti_injection($sql){
	   $sql = preg_replace(sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "" ,$sql); //retira funcoes sql
	   $sql = trim($sql); //Retira espaços em branco
	   $sql = strip_tags($sql); //Esta função tenta retornar uma string retirando todas as tags HTML e PHP de str.
	   $sql = (get_magic_quotes_gpc()) ? $sql : addslashes($sql); //Para saber se o Magic Quotes está ativado ou não. (On/Off) coloca / no lugar de '
	   return $sql;
	}
	$emailesqueci=$_POST["emailesqueci"];
	$emailesqueci=anti_injection($emailesqueci);
	
	$_SESSION["emailesqueci"]=$emailesqueci;
	$_SESSION["batata"]=$emailesqueci;
	
	
	$emailesqueci=strtolower($emailesqueci);
	$batata=$_SESSION["batata"];
	$sql="SELECT * FROM login WHERE lower(email) = '$emailesqueci'";
	$resultado= pg_query($conecta, $sql);
	$qtde=pg_num_rows($resultado);
		
	if ($qtde > 0)
	{
		for ($cont=0; $cont < $qtde; $cont++)
		{
			$linha=pg_fetch_array($resultado);
			if($linha['adm']=='n')
			{
						
				$sql1="SELECT * FROM cadastro WHERE lower(email) = '$batata'";
				$resultado1= pg_query($conecta, $sql1);
				$qtde1=pg_num_rows($resultado1);
				
				if ($qtde > 0)
				{
					for ($cont=0; $cont < $qtde; $cont++)
					{
						$linha1=pg_fetch_array($resultado1);
						$nome=$linha1['nome'];
					}
				}
			}
			else{
				$nome='adm';
			}
		}
		
					
		if($linha>0)
		{								
			date_default_timezone_set('Etc/UTC');
			require 'PHPMailerAutoload.php';
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 2;
			$mail->Debugoutput = 'html';
			$mail->Host = 'smtp.gmail.com';
			$mail->Port = 587;
			$mail->SMTPSecure = 'tls';
			$mail->SMTPAuth = true;
			$mail->Username = "grupotcchope@gmail.com";
			$mail->Password = "grupohope";
			$mail->setFrom('grupotcchope@gmail.com', 'Hope');
			$mail->addReplyTo('grupotcchope@gmail.com', 'Hope');
			$mail->addAddress("$emailesqueci", "$nome");
			$mail->Subject = 'Recuperacao de Senha | Hope';
$mail->msgHTML('
			<body style="margin:0px;">
<div style="width:100%; background-color:white;color: black; ">
 
 <div style="height:500px;">

   <div style="width:150%; height:15%; background-color:white;margin-bottom:10px;">
         <img src="../img/logo.jpg" width="100">  	 

	</div>
	
	<div style="width:100%; ">
	
		<div style="width:100%; background-color:white;color:black; padding-botom:20px; height:75px;float:left"><h2><center>Redefinir a senha</h2></center><br><br></div>
	<br><br>Ola, <b>' . $nome .' <br></b>
	Clique no link abaixo para alterar sua senha
	<br><br>
	<br>
<a id="botaoalterarsenha" style="text-transform: uppercase; outline: 0; background: #D9D9F3; width: 100%; border: 0; 
padding: 15px; color: black; font-size: 14px; -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
  margin-left:-30px; text-decoration: none;
margin-bottom:15px;" href="http://200.145.153.172/hope/tcc/alterarsenha.php">Alterar a senha</a>

</div>
</div>
	
		</body>
			
			
			');
		
		

			//Anexo
			//$mail->addAttachment('boleto.pdf');
			if (!$mail->send()) {
				echo "Não deu não";
			}else{
					//echo "Deu sim";
			}
				header('location:../login.php');											
			}
				else{
					?>
					<script type="text/javascript">
						alert("Não foi possível mudar a sua senha. Verifique seu email, por favor.");
					</script>
	<?php
				}				
			}
			else{
					unset ($_SESSION['usuario']);
					unset ($_SESSION['emailesqueci']);
					echo "<script type='text/javascript'>alert('Você deve estar cadastrado para conseguir alterar a sua senha!!!')</script>";
					echo  "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=../cadastrar.php'>";

		?>


<?php
				}
								pg_close($conecta);

								?>
								
</html>