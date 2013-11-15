<?php  require ('includes/connection.php');?>
<?php  include ('includes/headers.php');?>
<?php
	if (isset ($_POST["username"]) and isset($_POST["password"]) and isset($_POST["passagain"])) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$passagain = $_POST["passagain"];
		$hashed_password = md5($password);
		
			if(!empty($username) and !empty($password) and !empty($passagain)) {
				if ($password != $passagain) {
					echo "Please Your Password Dont Match, Type Again";
				} else {
					$query = "SELECT username FROM users WHERE username = '{$username}'";
					$query_check = mysql_query($query);
					$row_check = mysql_num_rows($query_check);
						if ($row_check == 1) {
							echo "USER EXISTS";
						} else {
							$query = "INSERT INTO users(id, username, hashed_password) VALUES ('', '{$username}', '{$hashed_password}')";
							$query_run = mysql_query($query);
								if ($query_run) {
									header("Location: staff.php");
									exit;
								} else {
									echo "Error Has Occured, Please Try Again Later";
								}
						}
				}
			} else {
				echo "Please Enter All The Fields";
			}
		
			
	}
?>
		<table id="structure">
			<tr>
				<td id="navigation">
					<a href="staff.php"> Return To Staff Menu</a>
				</td>
				<td id="page">
					<h2> Staff Menu</h2>
					<p>Welcome Stranger: Please Create Your Database</p>
					<ul>
						<form action="new_user.php" method="POST">
							Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" /> <br /> 
							Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" /> <br />
							Re-Enter Password<input type="password" name="passagain"><br />
							<input type="submit" value="Create User" />
						</form>
					</ul>
				</td>
			</tr>
		</table>
<?php include ('includes/footer.php');?>
