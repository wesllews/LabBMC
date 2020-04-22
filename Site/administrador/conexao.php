 <?php
 //Conecta com o PostgreSQL
 $conecta = pg_connect("host=127.0.0.1 port=5432 dbname=73b_hope
 user=hope password=grupohope");
if (!$conecta)
 {
 echo "Não foi possível estabelecer conexão com o banco de dados!<br><br>";
 exit;
 }

 ?>
