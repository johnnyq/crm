<?php
	
	include "config.php";

	$sql = "CREATE TABLE users (
	id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(30),
	password VARCHAR(128),
	date_added INT(10)
	)ENGINE = InnoDB";
	
	mysql_query($sql);

?>
