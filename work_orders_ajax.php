<?php 
	
	include "config.php";
	include "includes/check_login.php";

	$tbi = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'To Be Inspected'"));
	$ip = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'In Progress'"));
	$oh = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'On Hold'"));
	$rfc = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'Ready For Collection'"));

	if (isset($_GET['q'])){
		$q = $_GET['q'];
		$hide = '';
	}else{
		$q = 'To Be Inspected';
		$hide = 'hide';
	}
	
	$sql = mysql_query("SELECT * FROM users, customers, work_orders
			WHERE work_orders.take_in_employee = users.user_id
			AND work_orders.customer_id = customers.customer_id
			AND work_order_status = '$q'
			ORDER BY work_order_id DESC");
	
	$num_rows = mysql_num_rows($sql);

	if ($q == 'To Be Inspected'){
    	$hide = 'hide';
    }else{
    	$hide = '';
    }

?>

<?php if($num_rows > 0){ ?>
<table class="table">
	<thead>
		<tr>
			<th>Date</th>
			<th>Details</th>
			<th>Customer</th>
			<th>WO #/Takin</th>
			<th class="<?php echo $hide; ?>">Updated</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		
		<?php

		while($row = mysql_fetch_array($sql)){
            $type = ucwords($row['type']);
            if($type == 'Laptop'){
            	$type = 'fa fa-laptop';
            }elseif($type == 'Desktop'){
            	$type = 'fa fa-desktop';
            }
            $make = ucwords($row['make']);
            $model = ucwords($row['model']);
            $username = ucwords($row['username']);
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $customer_id = $row['customer_id'];
            $work_order_type = $row['work_order_type'];
            $take_in_date = date($date_format,$row['take_in_date']);
            $human_time = human_time($row['take_in_date']);
            $work_order_id = $row['work_order_id'];
            
            $sql2 = mysql_query("SELECT * FROM work_order_notes, users WHERE work_order_notes.employee = users.user_id AND work_order_id = $work_order_id ORDER BY work_order_note_id DESC LIMIT 1");
            $row2 = mysql_fetch_array($sql2);
            $date_note_added = date($date_format,$row2['date_added']);
            $human_time2 = human_time($row2['date_added']);
            $username_last_update = ucwords($row2['username']);

            echo "
				<tr>
					<td>$human_time</td>
					<td><i class='$type'></i> $make <small>$model<br>$work_order_type</small></td>
					<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>
					<td>$work_order_id<br><small>$username<small></td>
					<td class='$hide'>$human_time2<br><small>$username_last_update</small></td>
					<td>
						<div class='btn-group'>
							<a class='btn btn-primary' href='work_order_details.php?id=$work_order_id'><i class='glyphicon glyphicon-eye-open'></i></a>
							<a class='btn btn-default' href='print_work_order.php?id=$work_order_id'><i class='fa fa-print'></i></a>
						</div>
					</td>
				</tr>
			";
		}
	    
	    ?>
	
	</tbody>
</table>

<?php 

	}else{
		echo "<div class='alert alert-danger'>No Work Orders found!</div>";
	}

?>