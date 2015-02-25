<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	if(isset($_GET['id'])){
		$id = $_GET['id'];

	$sql = mysql_query("SELECT * FROM customers, work_orders, users 
		WHERE customers.customer_id = work_orders.customer_id 
		AND work_orders.take_in_employee = users.user_id 
		AND work_order_id = '$id'
	");

	$row = mysql_fetch_array($sql);

		$customer_id = $row['customer_id'];
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$address = $row['address'];
		$city = $row['city'];
		$state = $row['state'];
		$zip = $row['zip'];
		$email = $row['email'];
		$phone = $row['phone'];
		if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
		$mobile = $row['mobile'];
   		if(strlen($mobile)>2){ $mobile = substr($row['mobile'],0,3)."-".substr($row['mobile'],3,3)."-".substr($row['mobile'],6,4);}
		$asset_type = ucwords($row['type']);
        if($asset_type == 'Laptop'){
        	$asset_type = 'fa fa-laptop';
        }elseif($asset_type == 'Desktop'){
        	$asset_type = 'fa fa-desktop';
        }
		$asset_make = $row['make'];
		$asset_model = $row['model'];
		$asset_serial = $row['serial'];
		$scope = $row['work_order_type'];
		$description = $row['description'];
		$status = $row['work_order_status'];
		$human_time = human_time($row['take_in_date']);
		$date = date('M d Y', $row['take_in_date']);
		$time = date('g:i A', $row['take_in_date']);
		$username = ucwords($row['username']);
		$avatar = $row['avatar'];
?>


<div class="row">
	<div class="col-md-3">
		<table class="table table-bordered">
			<tr>
				<th class="well"><h4><?php echo "<a class='text-info' href='customer_details.php?id=$customer_id'><small><span class='glyphicon glyphicon-link'></span></small> $first_name $last_name</a>"; ?></h4></th>
			</tr>
			<tr>
				<td>
					<?php
					if($phone <> ''){ echo "<p><i class='fa fa-phone'></i> $phone</p>"; }
					if($mobile <> ''){ echo "<p><span class='glyphicon glyphicon-phone'></span> $mobile</p>"; }
					if($email <> ''){ echo "<p><span class='glyphicon glyphicon-envelope'></span> <small>$email</small></p>"; }
					?>
				</td>
			</tr>
			<tr>
				<td>
					<i class="<?php echo $asset_type; ?>"></i> <?php echo "$asset_make <small>$asset_model</small>"; ?><br>
					<small class="text-muted"><?php echo "$asset_serial"; ?></small>
				</td>
			</tr>
			<tr>
				<td>
					<p><?php echo "$scope"; ?></p>
					<p>
						<small class="text-muted"><?php echo "$description"; ?></small>
					</p>
				</td>
			</tr>
			<tr>	
				<td>	
					<div class="row">
						<div class="col-md-4" align="center">
							<img class="img-circle" src='<?php echo "$avatar"; ?>' height='64' width='64'>
							<p class="text-muted"><?php echo "$username"; ?></p>
						</div>
						<div class="col-md-8">
							<?php echo "$date"; ?><br>
							<small class="text-muted"><span class="glyphicon glyphicon-time"></span> <?php echo "$time"; ?></small><br>
							<small class="text-info"><?php echo "$human_time"; ?></small>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md-9">
		<div id="response"></div>
		<div class='btn-group'>
			<button class="btn btn-default" id="status_tbi" data-status="To Be Inspected">TBI</button>
			<button class="btn btn-default" id="status_ip" data-status="In Progress">IP</button>
			<button class="btn btn-default" id="status_oh" data-status="On Hold">OH</button>
			<button class="btn btn-default" id="status_rfc" data-status="Ready For Collection">RFC</button>
			<button class="btn btn-default" id="status_pu" data-status="Picked Up">PU</button>
		</div>
		<div class='btn-group pull-right'>
			<a href="print_work_order.php?id=<?php echo "$id"; ?>" class="tip btn btn-default" title="Print Work Order"><span class="glyphicon glyphicon-print"></span> Print</a>
			<button data-toggle="collapse" href="#collapseNote" class="tip btn btn-primary" title="Make a Note"><span class="glyphicon glyphicon-pencil"></span> Note</button>
		</div>
		<div id="collapseNote" class="panel-collapse collapse out">
		    <br>
		    <form id="ajaxform" class="form form-horizontal" autocomplete="off">
		      <input type="hidden" name="work_order_id" value="<?php echo $id; ?>">
		      <input type="hidden" name="new_work_order_note">
		      <div class="form-group">
		      	<div class="col-md-12">
		      		<textarea class="form-control input-lg" rows="4" name="note"></textarea>
		      	</div>
		      </div>
		      <div class="form-group">
		      	<div class="col-md-9">
		      		<select class="form-control input-lg" id="cannedResponses">
		      			<option>Select a canned response (Optional)</option>
		      			<option>Called customer, left VM to pickup</option>
		      			<option>Called customer, will be in to pickup</option>
		      			<option>Restored, Activated</option>
		      			<option>Diagnostics Passed (Mem/HDD)</option>
		      		</select>
		      	</div>
		      	<div class="col-md-3">
		      		<button class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-ok"></span> Add</button>
		      	</div>
		      </div>
		    </form>
		</div>
		<hr>
		<!-- Notes Start -->
		<div id="work_order_notes">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>
		<!-- Notes End -->
	</div>
</div>

<?php 
	}else{
?>
<div class="alert alert-danger">No Work Order Selected!</div>
<?php 
	}
 
	include "includes/footer.php";

?>
<script>

$(document).ready(function() {

    getCurrentWorkOrderStatus();
    updateWorkOrderNotes();
    
    $( '[id^="status_"]' ).click(function() {
        $('[id^="status_"]').removeClass("btn-primary");
        $(this).addClass("btn-primary");
        updateStatus(this);  
    }); 

    $("#cannedResponses").change(function() {
   		$("textarea[name=note]").val($(this).val());
 	});

    $("#ajaxform").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            updateWorkOrderNotes();
	            $('#collapseNote').collapse('toggle');
	        	$("#ajaxform")[0].reset();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

    function getCurrentWorkOrderStatus(){
    	var currentWorkOrderStatus = "<?php echo $status; ?>";
    	$('[id^="status_"]').removeClass("btn-primary");
    	
    	if(currentWorkOrderStatus == "To Be Inspected"){
       	    $("#status_tbi").addClass("btn-primary");
    	}
    	else if(currentWorkOrderStatus == "In Progress"){
    		$("#status_ip").addClass("btn-primary");
    	}
    	else if(currentWorkOrderStatus == "On Hold"){
    		$("#status_oh").addClass("btn-primary");
    	}
    	else if(currentWorkOrderStatus == "Ready For Collection"){
    		$("#status_rfc").addClass("btn-primary");
    	}else{
    		$("#status_pu").addClass("btn-primary");
    	}   	
    }

    function updateStatus(btnStatus){
    	var workOrderId = "<?php echo $id; ?>";
    	var workOrderStatus = $(btnStatus).attr("data-status");
    	$.ajax({
	    	url: "post.php?update_work_order_status&id="+workOrderId+"&status="+workOrderStatus+"",      
		}).success(function(response) {
	 		updateWorkOrderNotes();
		});
    }

    function updateWorkOrderNotes(){
    	var workOrderId = "<?php echo $id; ?>";
    	$.ajax({
	    	url: "wo_notes.php?id="+workOrderId+"",      
		}).success(function(response) {
			$("#work_order_notes").html(response); 		
		});
    }
})

</script>