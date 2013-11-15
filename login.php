<?php  include ('includes/headers.php');?>

<?php
	if (isset($_POST['username']) and isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hashed_password = md5($password);
		
			if (!empty($username) and !empty($password)) {
				$query = "SELECT id FROM users WHERE username = '{$username}' AND hashed_password = '{$hashed_password}'";
				$query_run = mysql_query($query);
				
				if (mysql_num_rows($query_run) == 0) {
					echo "Invalid Username/Password Combination";
				} elseif (mysql_num_rows($query_run) == 1) {
					//Now Set A Session Here With user Id
					echo $user_id = mysql_result($query_run, 0, 'id');
					$_SESSION['user_id'] = $user_id;//Putting The User Id In A Session
					header('Location: loginindex.php');
					exit;
				}
		
			} else {
				echo "Please Enter Both The Fields";
			}
	}
?>

<form action="<?php echo $current_file; ?>" method="POST">
	Username:<input type="text" name="username" />
	Password:<input type="password" name="password" />
	<input type="submit" name="submit" value="Log In">
	&nbsp; &nbsp;
	<a href="index.php">Return To Main Page</a>
</form>

<?php  include ('includes/footer.php');?>