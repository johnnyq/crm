<?php

include "config.php";
include "includes/check_login.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];

$sql = mysql_query("SELECT * FROM users, computer_returns, computers
    					WHERE computer_returns.employee_id = users.user_id
    					AND computer_returns.computer_id = computers.computer_id
    					AND computer_returns.customer_id = $id
    					ORDER BY return_id DESC");
				
				$num = mysql_num_rows($sql);
				if($num > 0){
			
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-refresh"></i> Returns History <span class="badge pull-right"><?php echo "$num"; ?></span></h3>
	</div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Returned/Sold</th>
				<th>Computer</th>
				<th>Returned By</th>
				<th>Why</th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				
				while ($row = mysql_fetch_array($sql)){
					
	                $type = ucwords($row['type']);
	                if($type == 'Laptop'){
	                	$type = 'fa fa-laptop';
	                }elseif($type == 'Desktop'){
	                	$type = 'fa fa-desktop';
	                }
	                $make = ucwords($row['make']);
	                $model = ucwords($row['model']);
	                $system_number = $row['system_number'];
	                $price = $row['price'];
	                $username = ucwords($row['username']);   
	                $return_date = date($date_format,$row['return_date']);
					$date_sale = date($date_format, $row['sale_date']);
					$reason = $row['reason'];
			    	
			    	echo "
						<tr>
							<td>$return_date<br><small class='text-muted'>$date_sale</small></td>
							<td><i class='$type'></i> $make <small>$model</small><br><small class='text-muted'>$system_number - $$price</small></td>
							<td>$username</td>			
							<td><small>$reason</small></td>
						</tr>
					";
				}

			?>
		
		</tbody>
	</table>
</div>

<?php
	} //End if no records found for Return History
}
?>