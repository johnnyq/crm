<?php

include "config.php";
include "includes/check_login.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
			
	$sql = mysql_query("SELECT * FROM computers, computer_sales, users 
			WHERE computer_sales.customer_id = $id 
			AND computer_sales.computer_id = computers.computer_id  
			AND computer_sales.employee_id = users.user_id
			ORDER BY sale_id DESC
		");
	
	$num = mysql_num_rows($sql);
	if($num>0){

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Sales History <span class="badge pull-right"><?php echo "$num"; ?></span></h3>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Sold</th>
				<th>Computer</th>
				<th>Seller</th>
				<th>Warranty</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				
				while ($row = mysql_fetch_array($sql)){
					$make = $row['make'];
					$model = $row['model'];
					$type = ucwords($row['type']);
	                if($type == 'Laptop'){
	                	$type_icon = 'fa fa-laptop';
	                }elseif($type == 'Desktop'){
	                	$type_icon = 'fa fa-desktop';
	                }
					$processor = $row['processor'];
					$memory = $row['memory'];
					$hard_drive = $row['hard_drive'];
					$serial = $row['serial'];
					$os = $row['os'];
					$price = $row['price'];
					$sale_date = $row['sale_date'];
					$warranty = $row['warranty'];
					$employee_id = $row['employee_id'];
					$username = ucwords($row['username']);
					$computer_id = $row['computer_id'];
					$customer_id = $row['customer_id'];
					$sale_id = $row['sale_id'];
					$system_number = $row['system_number'];
					$warranty_expired = ($warranty * 24 * 60 * 60) +  $sale_date;
					$warranty_expire = (round((($warranty_expired) - time()) / 86400));
					
					if($warranty_expire <=0 ){
						$warranty_expire = "Expired: " . date($date_format, $warranty_expired) ;
					}elseif ($warranty_expire == 1){
						$warranty_expire = $warranty_expire . " Day left";
					}else{
						$warranty_expire = $warranty_expire . " Days left";
					}
				  	
				  	$date_sale = date($date_format, $row['sale_date']);
			 
			    	echo "
						<tr>
							<td>$date_sale</td>
							<td><i class='$type_icon'></i> $make <small>$model</small><br><small class='text-muted'>$system_number - $serial</small></td>
							<td>$username</td>
							<td>$warranty_expire</td>
							<td>
								<div class='btn-group'>
								  <button type='button' class='btn btn-sm btn-default dropdown-toggle' data-toggle='dropdown'>
								    <i class='glyphicon glyphicon-cog'></i>
								  </button>
								  <ul class='dropdown-menu'>
								    <li><a id='btnExtendWarranty_$sale_id'><i class='glyphicon glyphicon-warning-sign'></i> Extend Warranty</a></li>
								    <li><a id='btnReturn_$sale_id'><i class='fa fa-refresh'></i> Return</a></li>
								    <li><a id='btnInsideWorkOrder_$sale_id'><i class='fa fa-wrench'></i> WorkOrder</a></li>
								    <li><a href='print_sales_agreement.php?id=$sale_id' target='_blank'><i class='fa fa-print'></i> Print</a></li>
								  </ul>
								</div>
				  			</td>
						</tr>
						<tr id='collapseReturn_$sale_id' class='hide' >
							<td colspan='5'>
						        <label>Reason For Return</label>
						        <textarea class='form-control input-lg' id='reason_$sale_id' rows='4' required></textarea>
						        <br>
						        <div class='btn-group pull-right'>
									<button class='btn btn-default btn-sm' id='btnCancelReturn_$sale_id'><span class='glyphicon glyphicon-remove'></span></button>
									<button class='btn btn-default btn-sm' id='submitReturn_$sale_id'><span class='glyphicon glyphicon-ok'></span></button>
								</div>
							</td>
						</tr>
						<tr id='collapseExtendWarranty_$sale_id' class='hide' >
							<td colspan='5'>
						        <label>Extend Warranty</label>
						        <select class='form-control input-lg' id='warranty_$sale_id' required>
						        	<option value='182'>6 Month</option>
						        	<option value='365'>1 Year</option>
						        	<option value='730'>2 Year</option>
						        </select>
						        <br>
						        <div class='btn-group pull-right'>
									<button class='btn btn-default btn-sm' id='btnCancelExtendWarranty_$sale_id'><span class='glyphicon glyphicon-remove'></span></button>
									<button class='btn btn-default btn-sm' id='submitExtendWarranty_$sale_id'><span class='glyphicon glyphicon-ok'></span></button>
								</div>
							</td>
						</tr>
						<tr id='collapseInsideWorkOrder_$sale_id' class='hide' >
							<td colspan='5'>
						        <input type='hidden' id='customer_$sale_id' value='$customer_id'>
						        <input type='hidden' id='type_$sale_id' value='$type'>
						        <input type='hidden' id='make_$sale_id' value='$make'>
						        <input type='hidden' id='model_$sale_id' value='$model'>
						        <input type='hidden' id='serial_$sale_id' value='$serial'>
						        <label>Scope</label>
						        <input type='text' class='form-control' id='scope_$sale_id' autofocus required>
							      <div class='checkbox'>
								    <label>
								      Priority <input type='checkbox'>
								    </label>
								  </div>
							      <div class='checkbox'>
								    <label>
								      Pay On Pickup <input type='checkbox'>
								    </label>
								  </div>
							      <div class='checkbox'>
								    <label>
								      Power Adapter <input type='checkbox'>
								    </label>
								  </div>
								  <div class='checkbox'>
								    <label>
								      Data Backup <input type='checkbox'>
								    </label>
								  </div>
							    <label>Takin Notes</label>
							    <textarea class='form-control' id='takein_notes_$sale_id' rows='6' required></textarea>
							    <br>
						        <div class='btn-group pull-right'>
									<button class='btn btn-default btn-sm' id='btnCancelInsideWorkOrder_$sale_id'><span class='glyphicon glyphicon-remove'></span></button>
									<button class='btn btn-default btn-sm' id='submitInsideWorkOrder_$sale_id'><span class='glyphicon glyphicon-ok'></span></button>
								</div>
							</td>
						</tr>
					";
				}

			?>
		
		</tbody>
	</table>
</div>

<?php
	}
}
?>