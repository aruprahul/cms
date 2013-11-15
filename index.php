<?php  require ('includes/connection.php');?>
<?php  require_once ('includes/functions.php');?>
<?php
	if (isset($_GET["subj"])) {
		$sel_subject = get_subject_by_id($_GET["subj"]);
		$sel_page = NULL;
	} else if (isset($_GET["page"])){
		$sel_subject = NULL;
		$sel_page = get_page_by_id($_GET["page"]);
	} else{
		$sel_subject = NULL;
		$sel_page = NULL;
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
			confirm_query($subject_set);
				while ($subject = mysql_fetch_array($subject_set)) {
					echo "<li";
					if ($subject['id'] == $sel_subject['id']) {
						echo " class='selected'";
					}
					echo "><a href=\"index.php?subj=".urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>";
					
					$query = "SELECT * FROM pages WHERE subject_id = {$subject['id']}";
					$page_set = mysql_query($query);
					confirm_query($page_set);
						echo "<ul class = 'pages'>";
						while ($page = mysql_fetch_array($page_set)) {
							echo "<li"; 
							if ($page["id"] == $sel_page['id']) {
								echo " class='selected'";
							}
							echo "><a href=\"index.php?page=".urlencode($page["id"])."\">{$page["menu_name"]}</a></li>";
						}
						echo "</ul>";
					
				}
				
			?>
			</ul>
			<br />
		</td>
		<td id="page">
			<?php
				if(!is_null($sel_subject)) { 
			?>
			<h2> <?php  echo $sel_subject["menu_name"];?></h2>
			<?php } elseif (!is_null($sel_page)) { 
			?>
			<h2> <?php  echo $sel_page["menu_name"];?></h2>
			<?php echo $sel_page['content']; ?>
			<?php } else {  ?>
			<h2>Welcome To The Fastest Growing MNC Widget Corp</h2>
			<br /><br />
			<a href="loginindex.php">Staff Login</a>
			<?php } ?>
		</td>
	</tr>
</table>
<?php  include ('includes/footer.php');?>