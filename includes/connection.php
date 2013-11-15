<?php
$host = 'localhost';
$user = 'root';
$pass = 'manchester170';
$db = 'widget';
$db2 = 'widget-corp';

	if(!@mysql_connect($host, $user, $pass) || !@mysql_select_db($db2)) {
		mysql_error();
	}
?>