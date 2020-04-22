<?php
	session_start();
	$_SESSION["nome"]++;
	$nome="wes".$_SESSION["nome"];
	echo $nome;
?>
<!DOCTYPE html>
<html>
<body>

<form action="inseririmagem.php" method="POST" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="arquivo" id="fileToUpload">
    <input type="hidden" name="pasta" value="./img/" >
    <input type="hidden" name="nome" value="wes2" >
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>