<?php  require ('includes/connection.php');?>
<?php  require_once ('includes/functions.php');?>
<?php
	if (isset($_POST["submit"])) {
		if(isset($_POST["paging"]) and isset($_POST["positioning"]) and isset($_POST["invisible"]) and isset($_POST["content"])) {
			$id = $_GET["page"];
			$paging = $_POST["paging"];
			$positioning = $_POST["positioning"];
			$invisible = $_POST["invisible"];
			$content = $_POST["content"];
			
				if(!empty($paging) and !empty($positioning) and !empty($invisible)) {
					$query = "UPDATE pages SET menu_name='{$paging}', position='{$positioning}', visible='{$invisible}', content='{$content}' WHERE id = '{$id}'";
					$requiring = mysql_query($query);
						if(mysql_affected_rows() == 1) {
							// echo "Success";
						} else {
							echo "Error";
						}
				} else {
					echo "Please Enter All Fields";
				}
		}
	}
?>
<?php

	if (isset ($_GET["subj"])) {
		$sel_subj = $_GET["subj"];
		$query = "SELECT * FROM subjects WHERE id = {$sel_subj} LIMIT 1";
		$total = mysql_query($query);
			if (!$total) {
				echo "Query Not OK";
			} else {
				if ($subject_fetch = mysql_fetch_array($total)) {
					// echo "Success";
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
		$total_set = mysql_query($query);
			if(!$total_set) {
				echo "Query Not Ok";
			} else {
				if($page_fetch = mysql_fetch_array($total_set)) {
					// echo "Success";
				} else {
					return NULL;
				}
			}
	} else {
		$sel_subj = 0;
		$subject_fetch = NULL;
		$sel_page = 0;
		$page_fetch= NULL;
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
								if ($subject['id'] == $sel_subj) {
									echo " class=\"selected\"";
								}
							echo "><a href=\" edit_subject2.php?subj=". urlencode($subject["id"])."\"> {$subject["menu_name"]} </a> </li>";
							
								$query = "SELECT * FROM pages WHERE subject_id = {$subject["id"]}";
								$page_set = mysql_query($query);
									if (!$page_set) {
										echo "Query Not Ok";
									} 
									echo "<ul class=\"pages\">";
									while ($page = mysql_fetch_array($page_set)) {
										echo "<li";
											if ($page["id"] == $sel_page) {
												echo " class=\"selected\"";
											}
										echo "><a href=\"edit_page2.php?page=". urlencode($page["id"])." \">{$page["menu_name"]} </a><br>";
									}
									echo "</ul>";
						}
						
					?>
				</ul>
				</td>
				<td id="page">
					<h2> Edit The Page: <?php echo $page_fetch["menu_name"];?></h2>
					
					<form action="edit_page2.php?page=<?php echo urlencode($page_fetch["id"]);?>" method="POST">
						Page Name:<input type="text" name="paging" value="<?php echo $page_fetch["menu_name"];?>" id="paging" />
						<p> Position:
							<select name="positioning">
								<?php
									$query = "SELECT * FROM pages";
									$resulting_set = mysql_query($query);
									$setting = mysql_num_rows($resulting_set);
										for($count=1; $count <= $setting+1; $count++) {
											echo "<option value={$count}";
												if($page_fetch["position"] ==  $count) {
													echo " selected";
												}
											echo ">{$count}</option>";
										}
								?>
							</select>
						</p>
						<p> Visible:
							<input type="radio" name="invisible" value="0" <?php if ($page_fetch["visible"] == 0) { echo " checked";} ?>/> No
							<input type="radio" name="invisible" value="1"<?php if ($page_fetch["visible"] == 1) { echo " checked"; } ?>/> Yes
						</p>
						
						<p> Content Area: <br />
							<textarea rows="10" cols="70" name="content"><?php echo $page_fetch["content"];?>
							</textarea>
						</p>
						
						<input type="submit" name="submit" value="Edit Page"/>

					<a href="xtra.php">Cancel</a>
				</td>
			</tr>
		</table>
<?php include ('includes/footer.php');?>