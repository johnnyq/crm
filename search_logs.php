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

	$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM logs, users WHERE logs.user_id = users.id AND (username LIKE '%$q%' OR log_type LIKE '%$q%' OR ip LIKE '%$q%' OR log_details LIKE '%$q%') ORDER BY log_id DESC LIMIT $record_from, $record_to");

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

	<table class="table table-bordered table-hover">	
	    <thead>	
	        <tr>	
	            <th><span class="glyphicon glyphicon-time"></span> Date</th>
	            <th><span class="glyphicon glyphicon-book"></span> Log</th>
				<th><span class="glyphicon glyphicon-globe"></span> IP Address</th>
				<th><span class="glyphicon glyphicon-user"></span> User</th>
				<th><span class="glyphicon glyphicon-eye-open"></span> Details</th>
			</tr>
		</thead>
	    <tbody>
			
	        <?php

				while($row = mysql_fetch_array($sql)){
	                $username = ucwords($row['username']);
	                $ip = ucwords($row['ip']);
	                $log_type = $row['log_type'];
	                $log_date = date('g:ia D M j Y ',$row['log_date']);
	                $log_details = $row['log_details'];
	         

	                echo "
						<tr>
							<td>$log_date</td>
							<td>$log_type</td>
							<td>$ip</td>
							<td>$username</td>
							<td>$log_details</td>
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