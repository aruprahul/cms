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
								echo "><a href=\"xtra.php?page=". urlencode($page["id"])."\">{$page["menu_name"]} </a></li>";
							 }
							 echo "</ul>";
						}
					?>
				</ul>
				<br />
				<a href="new_subject2.php">+ Add A New Subject</a>
				</td>

				<td id="page">
					<?php if(!is_null($subject_fetch)) { ?>
						<h2> <?php echo $subject_fetch["menu_name"]; ?></h2>
					<?php } elseif (!is_null($page_fetch)) { ?>
						<h2><?php echo $page_fetch["menu_name"]; ?></h2>
							<div class="page-content">
							<?php echo $page_fetch["content"];?>
							</div>
						<?php } else {?>
							<h2>Select A Subject Or Page To Edit</h2>
						<?php } ?>
				</td>
			</tr>
		</table>
<?php include ('includes/footer.php');?>