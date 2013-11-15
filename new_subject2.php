<?php  require ('includes/connection.php');?>
<?php  require_once ('includes/functions.php');?>
<?php
	if (isset($_GET["subj"])) {
		$sel_subj = $_GET["subj"];
		$query = "SELECT * FROM subjects WHERE id = {$sel_subj} LIMIT 1";
		$result_set = mysql_query($query);
			if (!$result_set) {
				echo "Query Not Ok";
			} else {
				if ($subject_fetch = mysql_fetch_array($result_set)) {
					//echo $subject["menu_name"];
			} else {
				return NULL;
			}
		}
		$sel_page = 0;
		$page_fetch = NULL;
		
	} elseif (isset($_GET["page"])) {
		$sel_subj = 0;
		$subject_fetch = NULL;
		$sel_page = $_GET["page"];
		$query = "SELECT * FROM pages WHERE id = {$sel_page} LIMIT 1";
		$resulting_set = mysql_query($query);
			if (!$resulting_set) {
				echo "Query Not Ok";
			} else {
				if ($page_fetch = mysql_fetch_array($resulting_set)) {
					// Worked
				} else {
					return NULL;
				}
			}
	} else {
		$sel_subj = 0;
		$subject_fetch = NULL;
		$sel_page = 0;
		$page_fetch = NULL;
	}
?>
<?php  include ('includes/headers.php');?>
		<table id="structure">
			<tr>
				<td id="navigation">
				<ul class="subjects">
					<?php
						$query = "SELECT * FROM subjects";
						$subject_set = mysql_query($query);
						if (!$subject_set) {
							echo "Query Not Ok";
						} 
						while ($subject = mysql_fetch_array($subject_set)) {
							echo "<li";
								if ($subject['id'] == $subject_fetch['id']) {
									echo " class='selected'";
								}
							echo "><a href=\"edit_subject2.php?subj=". urlencode($subject["id"])."\">{$subject['menu_name']} </a></li>";
							
							$query = "SELECT * FROM pages WHERE subject_id = {$subject["id"]}";
							$page_set = mysql_query($query);
							if (!$page_set) {
								echo "Query Not Ok";
							}
							echo "<ul class=\"pages\">";
							 while ($page = mysql_fetch_array($page_set)) {
								echo "<li";
								if ($page["id"] == $page_fetch["id"]) {
									echo " class='selected'";
								}
								echo "><a href=\"edit_page2.php?page=". urlencode($page["id"])."\">{$page["menu_name"]} </a></li>";
							 }
							 echo "</ul>";
						}
					?>
				</ul>
				</td>
				<td id="page">
					<h2> Add A Subject:</h2>
					<form action="create_subject2.php" method="POST">
						Subject Name:<input type="text" name="menu_name" value="" id="menu_name"/> <br /> 
						<p>Position:
							<select name="position">
							<?php
								$query = "SELECT * FROM subjects";
								$resulting = mysql_query($query);
								$set = mysql_num_rows($resulting);
									for($count=1; $count<=$set+1; $count++) {
										echo "<option value=\"{$count}\">{$count}</option>";
									}
							?>
							
							</select>
						</p>
						<p>Visible
							<input type="radio" name="visible" value="0"/>No
							&nbsp;
							<input type="radio" name="visible" value="1"/>Yes
						</p>
						<input type="submit" value="Add Subject" />
					</form>
					<br />
					<a href="xtra.php">Cancel</a>
				</td>
			</tr>
		</table>
<?php include ('includes/footer.php');?>