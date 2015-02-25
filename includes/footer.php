	</div>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  	<script src="js/app.js"></script>
  </body>
</html>

<?php 
	
	//LOGGING PAGE VIEWS
	$page = $_SERVER["REQUEST_URI"];
	$ip = $_SERVER['REMOTE_ADDR'];
	$log_date = time();
	$sql = "INSERT INTO logs VALUES('','Page View','$ip','$log_date','page \\<\\a href\\=\\$page\\>\\$page\\<\\/a\\>\\ viewed','$session_user_id')";
	mysql_query($sql);
		
?>