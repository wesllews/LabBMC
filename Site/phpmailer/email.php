<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset=utf-8>
	<link rel= "stylesheet" type= "text/css" href= "formatacao.css" />
	<link rel="icon" href="loginho.png">
	
	<title>Chavosas - Chaveiros criativos</title>
</head>
<body>
<?php
/**
 * Enviar por gmail
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username do Gmail
$mail->Username = "biadiasbarbosa86@gmail.com";

//Senha do usuário
$mail->Password = "Belinha123";

//Quem envia
$mail->setFrom('biadiasbarbosa86@gmail.com', 'Chavosas');

//Pra quem responde
$mail->addReplyTo('biadiasbarbosa86@gmail.com', 'Chavosas');

//Destinatário
$mail->addAddress('biadiasbarbosa@hotmail.com', 'Bianca');

//Assunto
$mail->Subject = 'Compra Finalizada';

//Pega o que tem no HTML
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'Sua compra foi realizada com sucesso!';

//Anexo
//$mail->addAttachment('boleto.pdf');

//Enviar a mensagem e ver se tem erro
if (!$mail->send()) {
    echo "Erro no envio: " . $mail->ErrorInfo;
} else {
    echo "Mensagem enviada!";
}

?>
</body>