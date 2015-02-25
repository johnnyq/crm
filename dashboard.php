<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$computers_today = mysql_num_rows(mysql_query("SELECT * FROM computers WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()"));
	$customers_today = mysql_num_rows(mysql_query("SELECT * FROM customers WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()"));
	$work_orders_today = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE DATE(FROM_UNIXTIME(take_in_date)) = CURDATE()"));
	$work_orders_tbi = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'To Be Inspected'"));
	$work_orders_ip = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'In Progress'"));
	$work_orders_oh = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'On Hold'"));
	$work_orders_rfc = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'Ready For Collection'"));
	$work_order_pu_today = mysql_num_rows(mysql_query("SELECT * FROM work_order_notes WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE() AND note = 'Status set to Picked Up'"));
	$work_order_notes_today = mysql_num_rows(mysql_query("SELECT * FROM work_order_notes WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()"));
	$sales_today = mysql_num_rows(mysql_query("SELECT * FROM computer_sales WHERE DATE(FROM_UNIXTIME(sale_date)) = CURDATE()"));
	$returns_today = mysql_num_rows(mysql_query("SELECT * FROM computer_returns WHERE DATE(FROM_UNIXTIME(return_date)) = CURDATE()"));
	$inventory_today_yesterday = mysql_num_rows(mysql_query("SELECT * FROM inventory WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE(),1)"));
	$desktop_stock = mysql_num_rows(mysql_query("SELECT * FROM computers WHERE status = 'stock' AND type = 'Desktop'"));
	$laptop_stock = mysql_num_rows(mysql_query("SELECT * FROM computers WHERE status = 'stock' AND type = 'Laptop'"));
	$desktop_stock = mysql_num_rows(mysql_query("SELECT * FROM computers WHERE status = 'stock' AND type = 'Desktop'"));
	$computer_stock = mysql_num_rows(mysql_query("SELECT * FROM computers WHERE status = 'stock'"));
	$computer_good_to_go = mysql_num_rows(mysql_query("SELECT * FROM computers WHERE status = 'goodtogo'"));

	mysql_query("SELECT os,COUNT(*) as count FROM computers GROUP BY os ORDER BY count DESC");
	mysql_query("SELECT price,COUNT(*) as count FROM computers GROUP BY price ORDER BY count DESC");
	mysql_query("SELECT make,COUNT(*) as count FROM computers GROUP BY make ORDER BY count DESC");
	mysql_query("SELECT model,COUNT(*) as count FROM computers GROUP BY model ORDER BY count DESC");
	mysql_query("SELECT zip,COUNT(*) as count FROM customers GROUP BY zip ORDER BY count DESC");
	mysql_query("SELECT referral,COUNT(*) as count FROM customers GROUP BY referral ORDER BY count DESC");
	mysql_query("SELECT work_order_type,COUNT(*) as count FROM work_orders GROUP BY work_order_type ORDER BY count DESC");
	mysql_query("SELECT make,COUNT(*) as count FROM work_orders GROUP BY make ORDER BY count DESC");
	mysql_query("SELECT model,COUNT(*) as count FROM work_orders GROUP BY model ORDER BY count DESC");
	mysql_query("SELECT type,COUNT(*) as count FROM work_orders GROUP BY type ORDER BY count DESC");



?>
<div class="row">
	<h4 class="text-center text-info"><i class='glyphicon glyphicon-stats'></i> Statistics Today</h4>
	<div class="col-md-offset-1 col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-group'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-success"><?php echo $customers_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>New Customers</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='glyphicon glyphicon-save'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-info"><?php echo $computers_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>Computers Refurbed</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-wrench'></i></div>
			<div class="panel-body">
				<a href="work_orders.php"><h2 class="text-center text-danger"><?php echo $work_orders_today; ?></h2></a>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>New Work Orders</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-shopping-cart'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-warning"><?php echo $sales_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>Computer Sales</small></div>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-refresh'></i></div>
			<div class="panel-body">
				<h2 class="text-center text-danger"><?php echo $returns_today; ?></h2>
			</div>
			<div class="panel-footer">
				<div class="text-center"><small>Computer Returns</small></div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<h4 class="text-center text-success"><span class='glyphicon glyphicon-stats'></span> Work Order Statistics</h4>
	<div class="col-md-offset-1 col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">To Be Inspected</div>
			<div class="panel-body">
				<a href="work_orders.php#To Be Inspected"><h2 class="text-center text-success"><?php echo $work_orders_tbi; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">In Progress</div>
			<div class="panel-body">
				<a href="work_orders.php#In Progress"><h2 class="text-center text-info"><?php echo $work_orders_ip; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">On Hold</div>
			<div class="panel-body">
				<a href="work_orders.php#On Hold"><h2 class="text-center text-danger"><?php echo $work_orders_oh; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Ready For Collect</div>
			<div class="panel-body">
				<a href="work_orders.php#Ready For Collection"><h2 class="text-center text-warning"><?php echo $work_orders_rfc; ?></h2></a>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Collected</div>
			<div class="panel-body">
				<h2 class="text-center text-success"><?php echo $work_order_pu_today; ?></h2>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<h4 class="text-center text-danger"><span class='glyphicon glyphicon-stats'></span> Stock</h4>
	<div class="col-md-offset-2 col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Laptops</div>
			<div class="panel-body">
				<h2 class="text-center text-success"><?php echo $laptop_stock; ?></h2>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Desktops</div>
			<div class="panel-body">
				<h2 class="text-center text-info"><?php echo $desktop_stock; ?></h2>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Total</div>
			<div class="panel-body">
				<h2 class="text-center text-danger"><?php echo $computer_stock; ?></h2>
			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading text-center">Good To Go</div>
			<div class="panel-body">
				<h2 class="text-center text-warning"><?php echo $computer_good_to_go; ?></h2>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<?php if($customers_today > 0){ ?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-group'></i> Customers Added Today</div>
			<table class="table">
				<thead>
					<tr>
						<td>Time</th>
						<td>Name</th>
						<td>City</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					$sql = mysql_query("SELECT * FROM customers
						WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE()
						ORDER BY customer_id DESC LIMIT 8"
					);

					while($row = mysql_fetch_array($sql)){
		                $customer_id = $row['customer_id'];
		                $first_name = $row['first_name'];
		                $last_name = $row['last_name'];
		                $city = $row['city'];
		                $human_time = human_time($row['date_added']);
		                $date_added = date('g:ia',$row['date_added']);
		                
		                echo "
							<tr>
								<td>$human_time</td>
								<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>
								<td>$city</td>
							</tr>
						";
					}
				    
				    ?>
				
				</tbody>
			</table>
			<div class="panel-footer"></div>
		</div>
	</div>

	<?php } if($computers_today > 0){ ?>

	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><span class='glyphicon glyphicon-save'></span> Computers Refurbished Today</div>
			<table class="table">
				<thead>
					<tr>
						<td>Time</th>
						<td>Computer</th>
						<td>Specs</td>
						<td>Price</td>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					$sql = mysql_query("SELECT * FROM computers WHERE DATE(FROM_UNIXTIME(date_added)) = CURDATE() ORDER BY computer_id DESC LIMIT 8");

					while($row = mysql_fetch_array($sql)){
		                $system_number = $row['system_number'];
		                $type = $row['type'];
		                if($type == 'Laptop'){
		                	$type = 'fa fa-laptop';
		                }elseif($type == 'Desktop'){
		                	$type = 'fa fa-desktop';
		                }
		                $make = $row['make'];
		                $model = $row['model'];
		                $price = $row['price'];
		                $memory = $row['memory'];
		                $processor = $row['processor'];
		                $os = $row['os'];
		                $hard_drive = $row['hard_drive'];
		                $human_time = human_time($row['date_added']);
		                $date_added = date('g:ia',$row['date_added']);
		           
		                echo "
							<tr>
								<td>$human_time</td>
								<td><i class='$type'></i> $make $model<br><small class='text-muted'>$system_number</td>
								<td><small>$processor/$memory MB/$hard_drive GB<br>$os</small></td>
								<td>$$price</td>
							</tr>
						";
					}

				    ?>
				
				</tbody>
			</table>
			<div class="panel-footer"></div>
		</div>
	</div>
	<?php } if($work_orders_today > 0){ ?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-wrench'></i> WorkOrders in Today</div>
			<table class="table">
				<thead>
					<tr>
						<td>Time</td>
						<td>Type</td>
						<td>User</td>
						<td>Asset</th>
						<td>Customer</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					$sql = mysql_query("SELECT * FROM users, customers, work_orders
    					WHERE work_orders.take_in_employee = users.user_id
    					AND work_orders.customer_id = customers.customer_id
    					AND DATE(FROM_UNIXTIME(take_in_date)) = CURDATE()
    					ORDER BY work_order_id DESC LIMIT 8"
    				);

					while($row = mysql_fetch_array($sql)){
		                $type = $row['type'];
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
		                $human_time = human_time($row['take_in_date']);
		                $take_in_date = date('g:ia',$row['take_in_date']);
		                
		                echo "
							<tr>
								<td>$human_time</td>
								<td>$work_order_type</td>
								<td>$username</td>
								<td><i class='$type'></i> $make <small>$model</small></td>
								<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>
							</tr>
						";
					}
				    
				    ?>
				
				</tbody>
			</table>
			<div class="panel-footer"></div>
		</div>
	</div>
	<?php } if($sales_today > 0){ ?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-shopping-cart'></i> Sales Today</div>
			<table class="table">
				<thead>
					<tr>
						<td>Time</th>
						<td>Computer</th>
						<td>Price</th>
						<td>Seller</th>
						<td>Customer</th>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					$sql = mysql_query("SELECT * FROM users, computer_sales, customers, computers
    					WHERE computer_sales.employee_id = users.user_id
    					AND computer_sales.computer_id = computers.computer_id
    					AND computer_sales.customer_id = customers.customer_id
    					AND DATE(FROM_UNIXTIME(sale_date)) = CURDATE()
    					ORDER BY sale_id DESC LIMIT 8"
    				);

					while($row = mysql_fetch_array($sql)){
		                $type = $row['type'];
		                if($type == 'Laptop'){
		                	$type = 'fa fa-laptop';
		                }elseif($type == 'Desktop'){
		                	$type = 'fa fa-desktop';
		                }
		                $make = ucwords($row['make']);
		                $model = ucwords($row['model']);
		                $price = $row['price'];
		                $username = ucwords($row['username']);   
		                $human_time = human_time($row['sale_date']);
		                $sale_date = date('g:ia',$row['sale_date']);
		                $first_name = $row['first_name'];
		                $last_name = $row['last_name'];
		                $customer_id = $row['customer_id'];
		                $system_number = $row['system_number'];
		                $warranty = $row['warranty'];
		                $total += $price;
		                echo "
							<tr>
								<td>$human_time</td>
								<td><i class='$type'></i> $make <small>$model</small><br><small class='text-muted'>$system_number - $warranty Day</small></td>
								<td>$$price</td>
								<td>$username</td>
								<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>					
							</tr>
						";
					}
				    ?>
				
				</tbody>
			</table>
			<div class="panel-footer text-center">Total: $<?php echo $total; ?></div>
		</div>
	</div>
	<?php } if($returns_today > 0){ ?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-refresh'></i> Returns Today</div>
			<table class="table">
				<thead>
					<tr>
						<td>Time</td>
						<td>Computer</td>
						<td>Price</td>
						<td>Returned By</td>
						<td>Customer</td>
						<td>Reason</td>
					</tr>
				</thead>
				<tbody>
					
					<?php
					
					$sql = mysql_query("SELECT * FROM users, computer_returns, customers, computers
    					WHERE computer_returns.employee_id = users.user_id
    					AND computer_returns.computer_id = computers.computer_id
    					AND computer_returns.customer_id = customers.customer_id
    					AND DATE(FROM_UNIXTIME(return_date)) = CURDATE()
    					ORDER BY return_id DESC LIMIT 8"
    				);

					while($row = mysql_fetch_array($sql)){
		                $type = $row['type'];
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
		                $human_time = human_time($row['return_date']);
		                $return_date = date('g:ia',$row['return_date']);
		                $first_name = $row['first_name'];
		                $last_name = $row['last_name'];
		                $customer_id = $row['customer_id'];
		                $reason = $row['reason'];
		                
		                echo "
							<tr>
								<td>$human_time</td>
								<td><i class='$type'></i> $make <small>$model</small><br><small>$system_number</small></td>
								<td>$$price</td>
								<td>$username</td>
								<td><a href='customer_details.php?id=$customer_id'>$first_name $last_name</a></td>					
								<td><small>$reason</small></td>
							</tr>
						";
					}
				    
				    ?>
				
				</tbody>
			</table>
			<div class="panel-footer"></div>
		</div>
	</div>
	<?php } if($work_order_notes_today > 0){ ?>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading text-center"><i class='fa fa-edit'></i> WorkOrder Notes Made Today</div>
			<table class="table">
				<tbody>
					
					<?php
					
					$sql = mysql_query("SELECT * FROM users, work_order_notes
    					WHERE work_order_notes.employee = users.user_id
    					AND DATE(FROM_UNIXTIME(date_added)) = CURDATE()
    					ORDER BY work_order_note_id DESC LIMIT 8"
    				);

					while($row = mysql_fetch_array($sql)){			
		                $work_order_id = $row['work_order_id'];
		                $username = ucwords($row['username']);
		                $note = $row['note'];
		                $human_time = human_time($row['date_added']);
		                $date_added = date('g:ia',$row['date_added']);
		                
		                echo "
							<tr>
								<td class='text-center'><small>$username<br>$human_time<br>WO # <a href='work_order_details.php?id=$work_order_id'>$work_order_id</a></small></td>
								<td><small>$note</small></td>
							</tr>
						";
					}
				    
				    ?>
				
				</tbody>
			</table>
			<div class="panel-footer"></div>
		</div>
	</div>
	<?php } ?>
</div>

<?php include "includes/footer.php"; ?>