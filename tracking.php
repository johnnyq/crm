<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    if (isset($_GET['p'])){
	    $p = intval($_GET['p']);
	    $record_from = (($p)-1)*10;
	    $record_to =  10;
	}else{
		$record_from = 0;
		$record_to = 10;
		$p = 1;
	}

    if (isset($_GET['q'])){
		$q = $_GET['q'];
	}

	$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM inventory, users, donors, tracking, locations
    					WHERE tracking.user_id = users.id
    					AND  tracking.inventory_id = inventory.inventory_id
    					AND tracking.location_id = locations.location_id
    					AND donors.donor_id = inventory.donor_id
    					AND (make LIKE '%$q%'
    					OR model LIKE '%$q%'
    					OR serial LIKE '%$q%'
    					OR username LIKE '%$q%'
    					OR location LIKE '%$q%'
    					OR donor LIKE '%$q%')
    					ORDER BY tracking_id DESC LIMIT $record_from, $record_to");

	$num = mysql_num_rows($sql);

	$num_rows = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / 10);

?>

<div class="row">
	<div class="col-md-3">
		<?php include "includes/admin_nav.php"; ?>
	</div>
	<div class="col-md-9">
		<form class="well well-sm" autocomplete="off">
			<div class="row">
				<div class="col-md-4">
					<div class="input-group">
						<input type="text" class="form-control" name="q" value="<?php if(isset($q)){echo $q;} ?>" placeholder="Search Query" autofocus>
						<span class="input-group-btn">
							<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</div>
			</div>
		</form> 

		<?php

		if($total_found_rows > 0) { 

		?>

		<table class="table table-bordered">	
		    <thead>	
		        <tr>	
		            <th><span class="glyphicon glyphicon-time"></span> Date</th>
					<th><span class="glyphicon glyphicon-tag"></span> Computer</th>
					<th><span class="glyphicon glyphicon-barcode"></span> Serial</th>
					<th><span class="glyphicon glyphicon-home"></span> Location</th>
					<th><span class="glyphicon glyphicon-user"></span> User</th>
					<th><span class="glyphicon glyphicon-refresh"></span> Donor</th>
				</tr>
			</thead>
		    <tbody>
				
		        <?php

					while($row = mysql_fetch_array($sql)){
						$id = $row['inventory_id'];
		                $make = $row['make'];
		                $model = $row['model'];
		                $serial = $row['serial'];
		                $username = $row['username'];
		                $donor_id = $row['donor_id'];
		                $donor = $row['donor'];
		                $location = $row['location'];
		                $date_added = date('n/d/y - g:ia',$row['date_added']);
		                $tracking_date = date('n/d/y - g:ia',$row['tracking_date']);
		                if($session_security == 0){
		                	$hide = "hide";
		                }

		                
		                echo "
							<tr>
								<td>$tracking_date</td>
								<td>$make $model</td>
								<td>$serial</td>
								<td>$location</td>
								<td>$username</td>
								<td><a href='donor_details.php?donor_id=$donor_id'>$donor</a></td>
							</tr>
						";
					}
				?>
			
		    </tbody>
		</table>

		<?php

			include("includes/pagination.php");

			}else{
				echo "<div class='alert alert-warning'>No records found.</div>";
			}

		?>

	</div>
</div>

<?php include "includes/footer.php"; ?>