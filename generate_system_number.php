<?php 

include("config.php");
include("includes/check_login.php");

$sql = mysql_query("SELECT * FROM users WHERE user_id=$session_user_id ");
	while ($row = mysql_fetch_array($sql)){
		$new_system_number = $session_user_first_name[0].$session_user_last_name[0];
	}

	$sql = mysql_query("SELECT  MAX(
	  CAST(
	    SUBSTRING(system_number, 3,7) AS UNSIGNED)
	  ) 

	AS system_number FROM computers WHERE system_number LIKE '$new_system_number%'");
	 

	if (mysql_num_rows($sql)==0){
		$system_number=1;
		}else{
			while($row = mysql_fetch_array($sql)){
				$system_number = $row['system_number'];

		}	
	}
	//generate user's initials
	$system_number = $system_number + 1;

	for ($i=strlen($system_number); $i<3; $i++){
		$new_system_number = $new_system_number."0";
	}

	$new_system_number = $new_system_number.$system_number;

	echo $new_system_number;

?>