<?php  require ('includes/connection.php');?>
<?php  require_once ('includes/functions.php');?>

<?php
	$id = $_GET["subj"];
	
	$query = "DELETE FROM subjects WHERE id = '{$id}'";
	$redhotchilipeppers = mysql_query($query);
	if (!$redhotchilipeppers) {
		echo "Query Not ok";
	} else {
		if (mysql_affected_rows() == 1) {
			// Success
			header('Location: xtra.php');
			exit;
		} else {
			echo "Error Has Occured Please Try Again Later";
		}
	}
?>