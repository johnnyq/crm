<?php

include "config.php";

if(isset($_GET['q'])){
	$q = $_GET['q'];
	$sql = mysql_query("SELECT * FROM users WHERE username = '$q' OR user_email = '$q'");
	if(mysql_num_rows($sql) == 1){

		while($row = mysql_fetch_array($sql)){
			$avatar = $row['avatar'];

			echo "<div align='center'><img class='img-circle' src='$avatar' height='142' width='142'></img></div><br>";
		}
	}
}

?>