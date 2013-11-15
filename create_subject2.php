<?php  require ('includes/connection.php');?>
<?php  require_once ('includes/functions.php');?>

<?php
	if(isset($_POST['menu_name']) and isset($_POST['position']) and isset($_POST['visible'])) {
		$menu_name = mysql_real_escape_string($_POST['menu_name']);
		$position = mysql_real_escape_string($_POST['position']);
		$visible = mysql_real_escape_string($_POST['visible']);
			if (!empty($menu_name) and !empty($position) and !empty($visible)) {
				$query = "INSERT INTO subjects (id, menu_name, position, visible) VALUES ('', '{$menu_name}', '{$position}', '{$visible}')";
				$result_data = mysql_query($query);
				if ($result_data) {
					header ('Location: xtra.php');
					exit;
				} else {
					echo "Error in query execution";
				}
			} else {
				echo "Please enter in all the fields";
			}
	}
	
?>