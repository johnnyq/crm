<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	if(isset($_GET['id'])){
		$inventory_id = $_GET['id'];
	}

	$sql = mysql_query("SELECT * from inventory, users, donors WHERE inventory.user_id = users.id AND inventory.donor_id = donors.donor_id AND inventory.inventory_id = $inventory_id");

	$row = mysql_fetch_array($sql);
	
	$inventory_id = $row['inventory_id'];
    $make = ucwords($row['make']);
    $model = ucwords($row['model']);
    $serial = $row['serial'];
    $username = ucwords($row['username']);
    $donor_id = $row['donor_id'];
    $donor = ucwords($row['donor']);
    $date_added = date('n/d/y - g:ia',$row['date_added']);

?>
<div class="row">
	<div class="col-md-12">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="search_inventory.php">Inventory</a></li>
		  <li class="active">Inventory Details</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<table class="table">
				<tr class="well">
					<th><span class="glyphicon glyphicon-tag"></span> Computer</th>
				</tr>
				<tr>
					<td><?php echo "$make $model<br>$serial"; ?></td>
				</tr>
				<tr>
					<th class="well"><span class="glyphicon glyphicon-refresh"></span> Donor</th>
				</tr>
				<tr>
					<td><?php echo "$donor"; ?></td>
				</tr>
				<tr>
					<th class="well"><span class="glyphicon glyphicon-time"></span> Date Added</th>
				</tr>
				<tr>	
					<td><?php echo "$date_added"; ?></td>
				</tr>
				<tr>
					<th class="well"><span class="glyphicon glyphicon-user"></span> User</th>
				</tr>
				<tr>
					<td><?php echo "$username"; ?></td>
				</tr>
			</table>	
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-heading"><span class="glyphicon glyphicon-transfer"></span> Location Tracking</div>
			<table class="table">	
			    <thead>	
			        <tr>	
			            <th><span class="glyphicon glyphicon-time"></span> Date</th>
						<th><span class="glyphicon glyphicon-home"></span> Location</th>
						<th><span class="glyphicon glyphicon-user"></span> User</th>
					</tr>
				</thead>
			    <tbody>
					
			        <?php
						$sql = mysql_query("SELECT * FROM users, locations, tracking WHERE 
							tracking.location_id = locations.location_id AND 
							tracking.user_id = users.id AND
							tracking.inventory_id = $inventory_id
							ORDER BY tracking_id DESC");

						while($row = mysql_fetch_array($sql)){
			                $tracking_date = date('n/d/y - g:ia',$row['tracking_date']);
			                $location_id = $row['location_id'];
			                $location = $row['location'];
			                $username = $row['username'];
			                
			                echo "
								<tr>
									<td>$tracking_date</td>
									<td>$location</td>
									<td>$username</td>
								</tr>
							";
						}
					?>
				
			    </tbody>
			</table>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>