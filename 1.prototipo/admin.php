<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';
?>
<div class="container-fluid px-5 pt-5">
	<h1>Dashboard</h1>
	<div class="pt-1 bg-warning"></div>
</div>
<?php include 'footer.php'; ?>