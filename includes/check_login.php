<?php
	
	session_start();
	
	if(!$_SESSION['logged']){
	    header("Location: login.php");
	    die;
	}

	$session_user_id = $_SESSION['user_id'];

	$sql = mysql_query("SELECT * FROM users WHERE user_id = $session_user_id");
	$row = mysql_fetch_array($sql);
	$session_username = ucwords($row['username']);
	$session_user_first_name = ucwords($row['user_first_name']);
	$session_user_last_name = ucwords($row['user_last_name']);
	$session_security_level = $row['security_level'];
	$session_avatar = $row['avatar'];
	$session_location_id = $row['location'];

	$sql = mysql_query("SELECT * FROM locations WHERE location_id = $session_location_id");
	$row = mysql_fetch_array($sql);
	$session_location = $row['location'];

	if($session_security == 0){
    	$hide = "hide";
    }

    $message_count = mysql_num_rows(mysql_query("SELECT * FROM messages WHERE message_to = $session_user_id AND message_active = 1"));

?>