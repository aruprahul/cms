<?php require ('core.php'); ?>
<?php  require ('includes/connection.php');?>


<?php
if (loggingin()) {
	header('Location: staff.php');
	exit;
} else {
		include('login.php'); 
}
	
?>


