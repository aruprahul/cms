<?php
//Here we will include all the function

function redirect_to($location = NULL) {
	if($location != NULL) {
		header('Location: {$location}');
		exit;
	}
}

function confirm_query($result_set) {
	if (!$result_set) {
		echo "Query Not OK";
	}
}



function get_subject_by_id($subject_id) {
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE id=". $subject_id ." ";
	$query .= "LIMIT 1";//It will limit the no. of searches for 1, precautionary measures
	
	$result_set = mysql_query($query);
	confirm_query($result_set);
	// IF NO ROWS ARE RETURNED , FETCH ARRAY WILL RETURN FALSE
	if ($subject = mysql_fetch_array($result_set)) {
		return $subject;
	} else {
		return NULL;
	}
}

function get_page_by_id($page_id) {
	$query = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id= ". $page_id ." ";
	$query .= "LIMIT 1";
	
	$result_set = mysql_query($query);
	confirm_query($result_set);
	
	if ($page = mysql_fetch_array($result_set)) {
		return $page;
	} else {
		return NULL;
	}
}

function navigation($sel_subject, $sel_page) {
	$output = "<ul class=\"subjects\">";
	$query = "SELECT * FROM subjects";
	$subject_set = mysql_query($query);
	confirm_query($subject_set);
	while ($subject = mysql_fetch_array($subject_set)) {
					$output .= "<li";
					if ($subject['id'] == $sel_subject['id']) {
						echo " class='selected'";
					}
					$output .= "><a href=\"edit_subject.php?subj=" .urlencode($subject["id"])."\">{$subject["menu_name"]}</a></li>";
					
					$query = "SELECT * FROM pages WHERE subject_id = {$subject['id']}";
					$page_set = mysql_query($query);
					confirm_query($page_set);
						$output .= "<ul class = 'pages'>";
						while ($page = mysql_fetch_array($page_set)) {
							$output .= "<li"; 
							if ($page["id"] == $sel_page['id']) {
								echo " class='selected'";
							}
							$Output .= "><a href=\"content.php?page=".urlencode($page["id"])."\">{$page["menu_name"]}</a></li>";
						}
						$output .= "</ul>";
					
				}
}



?>