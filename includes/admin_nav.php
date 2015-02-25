
<ul class="nav nav-pills nav-stacked well">
 	<li><h4>Admin Menu</h4></li>
 	<li <?php if($_SERVER["REQUEST_URI"] == "/search_users.php") { echo 'class="active"';} ?> ><a href="search_users.php"><span class="glyphicon glyphicon-user"></span> Users</a></li>
	<li <?php if($_SERVER["REQUEST_URI"] == "/search_locations.php") { echo 'class="active"';} ?> ><a href="search_locations.php"><span class="glyphicon glyphicon-home"></span> Locations</a></li>
	<li <?php if($_SERVER["REQUEST_URI"] == "/search_donors.php") { echo 'class="active"';} ?> ><a href="search_donors.php"><span class="glyphicon glyphicon-refresh"></span> Donors</a></li>
	<li <?php if($_SERVER["REQUEST_URI"] == "/tracking.php") { echo 'class="active"';} ?> ><a href="tracking.php"><span class="glyphicon glyphicon-transfer"></span> Tracking Log</a></li>
	<li <?php if($_SERVER["REQUEST_URI"] == "/search_logs.php") { echo 'class="active"';} ?> ><a href="search_logs.php"><span class="glyphicon glyphicon-book"></span> Logs</a></li>
</ul>