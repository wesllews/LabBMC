<html>
<?php
session_start();
$pasta = $_POST["pasta"];
$nome = $_POST["nome"];
$redirect = $_POST["redirect"];
$redirect_error = $_POST["redirect_error"];
$target_file = $pasta . basename($_FILES["arquivo"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$target_file = $pasta.$nome.".".$imageFileType;
$_SESSION['nome_img_questao'] = $target_file;

// Check if file already exists
if (file_exists($target_file)) {
	unlink($target_file);
	header($_SERVER['PHP_SELF']);
}
// Check file size
if ($_FILES["arquivo"]["size"] > 50000000) {
    echo "<script>alert('A imagem excede o tamanho ideal');</script>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif") {
    echo "<script>alert('Desculpe, apenas os formatos JPG, JPEG, PNG e GIF são permitidos');</script>";
	$uploadOk = 0;	
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>alert('Desculpe, não foi possível cadastrar .');</script>";
	header('Location: '.$redirect_error);
// if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $target_file)) {
        echo "O arquivo foi enviado com sucesso!";
        if($redirect != ''){
            header('Location: '.$redirect);
        }
    } else {
    	echo $_FILES['userfile']['error'];
        echo "<script>alert('Desculpe, não foi possível cadastrar sua imagem.');</script>";
    }
}
?>
</html>