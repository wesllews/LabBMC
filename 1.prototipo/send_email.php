<?php
session_start();
$_SESSION['pagina']='admin';
include 'header.php';


if (isset($_POST['message'])) {

	$from = $_POST['FromEmail'];
	$to      = $_POST['ToEmail'];
	$subject = "BLT Database: ".$_POST['subject'];
	$message = $_POST['message'];
	$headers = 'From: '.$from."\r\n".'Reply-To: '.$from."\r\n".'X-Mailer: PHP/' . phpversion();

	if(mail($to, $subject, $message, $headers)){
		echo '<script> alert("Your message was successfully sent!");</script>';
		echo "<script>window.close();</script>";
	} else {
		echo '<script> alert("Something went wrong!!");</script>';
	}
}

?>

<div class="text-warning m-3" style="white-space: nowrap;"><h3 class="ml-5">Send a message to: <?php echo $_POST['name'];?></h3><hr></div>

<div class="container">
	<div class="row py-5">
		<div class="d-none d-lg-block col-lg-2">
			<!-------null------>
		</div>

		<div class="col-xs-12 col-lg-8 py-5 bg-light shadow-sm">
			<form method="POST" action="send_email.php">
				<!--From: -->
				<div class="form-group row">
					<label for="FromEmail" class="col-sm-2 col-form-label">From:</label>
					<div class="col-sm-10">
						<input type="email" name="FromEmail" class="form-control" id="FromEmail" value="<?php echo $_SESSION[email];?>" required>
					</div>
				</div>

				<!--To: -->
				<div class="form-group row">
					<label for="ToEmail" class="col-sm-2 col-form-label">To:</label>
					<div class="col-sm-10">
						<input type="email" name="ToEmail" class="form-control" id="ToEmail" value="<?php echo $_POST[ToEmail];?>" readonly required>
					</div>
				</div>

				<!--Subject: -->
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Subject:</label>
					<div class="col-sm-10">
						<input type="text" name="subject" class="form-control" placeholder="Subject" value="<?php echo $_POST[subject];?>" required>
					</div>
				</div>

				<!--Message: -->
				<div class="form-group">
				    <label>Message:</label>
				    <textarea name="message" class="form-control" rows="6" placeholder="Hello, <?php echo $_POST[name];?>..." value="<?php echo $_POST[message];?>" required></textarea>
				</div>

				<button type="submit" class="btn btn-success float-right px-5">Send email</button>
			</form>
		</div>

		<div class="d-none d-lg-block col-lg-2">
			<!-------null------>
		</div>
	</div>
</div>




<?php include 'footer.php'; ?>