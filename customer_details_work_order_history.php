<?php

include "config.php";
include "includes/check_login.php";

if(isset($_GET['id'])){
	$id = intval($_GET['id']);

$sql = mysql_query("SELECT * FROM work_orders 
			WHERE customer_id = $id
			AND work_order_status = 'Picked Up'
			ORDER BY work_order_id DESC"
);
	
$num = mysql_num_rows($sql);
if($num>0){

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-wrench"></i> WorkOrder History <span class="badge pull-right"><?php echo "$num"; ?></span></h3>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Date</th>
				<th>Type</th>
				<th>Asset</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			
			<?php
				
				while ($row = mysql_fetch_array($sql)){
					$work_order_id = $row['work_order_id'];
					$customer_id = $row['customer_id'];
					$pick_up_date = date($date_format, $row['date_closed']);
			  		$take_in_date = date($date_format, $row['take_in_date']);
					$type = ucwords($row['type']);
	                if($type == 'Laptop'){
	                	$type_icon = 'fa fa-laptop';
	                }elseif($type == 'Desktop'){
	                	$type_icon = 'fa fa-desktop';
	                }
					$make = $row['make'];
					$model = $row['model'];
					$serial = $row['serial'];
					$work_order_type = $row['work_order_type'];
			    	
			    	echo "
						<tr>
							<td>$take_in_date</td>
							<td>$work_order_type</td>
							<td><i class='$type_icon'></i> $make <small>$model</small></td>
							<td>
								<div class='btn-group'>
				  					<a class='btn btn-default btn-sm' id='btnInsideWorkOrder_$work_order_id'><i class='fa fa-wrench'></i></a>
				  					<a class='btn btn-default btn-sm' href='print_work_order.php?id=$work_order_id' target='_blank'><i class='fa fa-print'></i></a>
				  					<a class='btn btn-default btn-sm' href='work_order_details.php?id=$work_order_id'><i class='glyphicon glyphicon-eye-open'></i></a>
				  				</div>
				  			</td>
						</tr>
						<tr id='collapseInsideWorkOrder_$work_order_id' class='hide' >
							<td colspan='5'>
						        <input type='hidden' id='customer_$work_order_id' value='$customer_id'>
						        <input type='hidden' id='type_$work_order_id' value='$type'>
						        <input type='hidden' id='make_$work_order_id' value='$make'>
						        <input type='hidden' id='model_$work_order_id' value='$model'>
						        <input type='hidden' id='serial_$work_order_id' value='$serial'>
						        <label>Scope</label>
						        <input type='text' class='form-control' id='scope_$work_order_id' autofocus required>
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
							    <textarea class='form-control' id='takein_notes_$work_order_id' rows='6' required></textarea>
							    <br>
						        <div class='btn-group pull-right'>
									<button class='btn btn-default btn-sm' id='btnCancelInsideWorkOrder_$work_order_id'><span class='glyphicon glyphicon-remove'></span></button>
									<button class='btn btn-default btn-sm' id='submitInsideWorkOrder_$work_order_id'><span class='glyphicon glyphicon-ok'></span></button>
								</div>
							</td>
						</tr>
					";
				}
				$count = mysql_num_rows($sql);

			?>
		
		</tbody>
	</table>
</div>

<?php
	} //End if no records found for Work Order History
}
?>

<script>
$(document).ready(function() {
	$( '[id^="btnInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		collapseInsideWorkOrder(id);
	});

	$( '[id^="btnCancelInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		cancelInsideWorkOrder(id);
	});

	$( '[id^="submitInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		processInsideWorkOrder(id);
	});

	function collapseInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).removeClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).hide();
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).addClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
		
	}

	function processInsideWorkOrder(id){	
		var customer = $( "#customer_"+id ).val();
		var type = $( "#type_"+id ).val();
		var make = $( "#make_"+id ).val();
		var model = $( "#model_"+id ).val();
		var serial = $( "#serial_"+id ).val();
		var scope = $( "#scope_"+id ).val();
		var takeInNotes = $( "#takein_notes_"+id ).val();
		$.ajax({
	    	url: "post.php?new_inside_work_order="+id+"&scope="+scope+"&takein_notes="+takeInNotes+"&type="+type+"&make="+make+"&model="+model+"&serial="+serial+"&customer_id="+customer+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelInsideWorkOrder(id);
			loadOpenWorkOrders();
			loadWorkOrderHistory();
		});
	}

	function loadOpenWorkOrders(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_open_work_orders.php?id="+customerId+"",      
		}).success(function(response) {
			$("#openWorkOrders").html(response); 		
		});
	}

	function loadWorkOrderHistory(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_work_order_history.php?id="+customerId+"",      
		}).success(function(response) {
			$("#workOrderHistory").html(response); 		
		});
	}
})

</script>