	<body>
	<head language="pt-br">
		<meta charset="UTF-8">
	</head>
	<?php 
	session_start();	
	include "../conecta.php";
	//$emailesqueci=$_SESSION["emailesqueci"];
	$emailesqueci=$_SESSION["batata"];
	echo $_SESSION["batata"];
	echo $emailesqueci;
	//$emailesqueci=$_GET["usuario"];

	//$emailesqueci="paulocesar21vendas@hotmail.com";
	$nome="BATATA";
	echo 	"EMAIL:".$emailesqueci;					
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
			$mail->Subject = 'Alteracao de senha | Hope';
$mail->msgHTML('
<body style="margin:0px; hidden-xs">
<div style="width:100%; background-color:white;">
 
 <div style="height:500px;">

    <div style="width:100%; height:15%; background-color:white; padding-left:5px;  margin-bottom:10px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="../img/logo.jpg" width="100">  		  
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <img src="../img/softbio.png" width="100">  
	</div>
	
	<div style="width:100%;">
	<h2><center><br><br><br><br>Sua senha foi alterada com sucesso</h2></center><br>
	<p><center>Obrigado por utilizar o nosso sistema!</center></p>

</div>

</div>
	
		</body>
			
			
			');
		
		

			//Enviar a mensagem e ver se tem erro
			//$mail->addAttachment('boleto.pdf');
			if (!$mail->send()) {
				echo "Não foi possível enviar o email de alteração de senha";
				echo "EMAIL ESQUECI:".$emailesqueci;
				//header('location: ../login.php');
			}else{
				//	echo "Deu sim";
				?>
				<?php
				unset ($_SESSION["batata"]);
				header('location: ../index.php');	
			}
				//header('location:../login.php');											

			pg_close($conecta);

			?>
	</body>						
