
<?php
define ("MAX_SIZE","100");

$uploaddir = './img/';
$nome=$_POST['id'];
//$nome="BANANA";
$uploadfile = $uploaddir.$nome.".png";
echo $uploadfile;
$size=filesize($_FILES['arquivo']['tmp_name']);

			if ($size > MAX_SIZE*256)//tamanho superior
               {
                   ?>
				    <script type='text/javascript'>alert('A imagem nao pode exceder 25');
			   else{kb!');
					  window.location.href="cadastrounidadeadm.php";
              </script><?php
               }
				 if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile))
			{?>
					  <script type='text/javascript'>alert('Imagem Inserida');
					  window.location.href="cadastrounidadeadm.php";
					  </script>
			 <?php	}
			
			else {  ?>
				<script type='text/javascript'>alert('Unidade inserida mas houve um erro com a foto');
				//window.location.href="cadastrounidadeadm.php";
				</script>
			<?php	
			}
			   
    
  ?>