<?php 
$password = md5($_POST['password']);
$query= "SELECT * FROM `login` WHERE email='$_POST[email]' and password='$password';";
$result = $mysqli->query($query);
$rows =$result->num_rows;
if ($rows==1) {
	$rows = $result->fetch_array();

	if(!in_array($rows['status'], array("requested","denied"))){
		$_SESSION['login']="sim";
		$_SESSION['status']=$rows['status'];
		$_SESSION['email']=$rows['email'];
		header("Location: index.php");
	} elseif($rows['status']=="requested") {
		$_SESSION['login']="nao";
		?>
		<div class="alert alert-primary alert-dismissible fade show" role="alert">
			Your request is under evaluation! We will contact you by email when it is analyzed!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
	} elseif($rows['status']=="denied") {
		$_SESSION['login']="nao";
		?>
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Unfortunately your access was denied! Try to contact our administrators to review your profile.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<?php
	}						
}	elseif(isset($_POST['email'])) {
	$_SESSION['login']="nao";
	?>
	<div class="alert alert-danger alert-dismissible fade show" role="alert">
	  Something went wrong with the <strong>User</strong> or <strong>Password</strong>!
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<?php
}
?>