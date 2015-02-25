<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	}

	$sql = mysql_query("SELECT * FROM customers WHERE customer_id = $id");

	$row = mysql_fetch_array($sql);
	
	$company = $row['company'];
    $last_name = ucwords($row['last_name']);
    $first_name = ucwords($row['first_name']);
    $address = ucwords($row['address']);
    $city = $row['city'];
    $state = $row['state'];
    $zip = $row['zip'];
    $phone = $row['phone'];
    if(strlen($phone)>2){ $phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);}
    $mobile = $row['mobile'];
    if(strlen($mobile)>2){ $mobile = substr($row['mobile'],0,3)."-".substr($row['mobile'],3,3)."-".substr($row['mobile'],6,4);}
    $email = $row['email'];

?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Customer</h3>
	</div>
	<div class="panel-body">
	    <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="customers.php">Customers</a></li>
		  <li><a href="customer_details.php?id=<?php echo $id; ?>">Customer Details</a></li>
		  <li class="active">Edit Customer</li>
		</ol>    

	    <div id="response"></div>

	    <form id="ajaxform" class="form-horizontal col-sm-5" autocomplete="off">
	      <input type="hidden" name="edit_customer">
	      <input type="hidden" name="id" value="<?php echo $id; ?>">
	       <div class="form-group has-feedback">
	        <label class="control-label col-sm-3">Company</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="company" value="<?php echo $company; ?>">
		        <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="control-label col-sm-3">First Name</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="first_name" required value="<?php echo $first_name; ?>">
		        <span class="glyphicon glyphicon-user form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group">
	        <label class="control-label col-sm-3">Last Name</label>
	        <div class="col-md-9">
	      		<input type="text" class="form-control" name="last_name" required value="<?php echo $last_name; ?>">
	      	</div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="control-label col-sm-3">Address</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="address" required value="<?php echo $address; ?>">
		        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group">
	        <label class="control-label col-sm-3">City</label>
	        <div class="col-md-9">
	        	<input type="text" class="form-control" name="city" required value="<?php echo $city; ?>">
	        </div>
	      </div>
	      <div class="form-group">
	        <label class="control-label col-sm-3">State</label>
	        <div class="col-md-9">
	        	<input type="text" class="form-control" name="state" required value="<?php echo $state; ?>">
	       	</div>
	      </div>
	      <div class="form-group">
	        <label class="control-label col-sm-3">Zip Code</label>
	        <div class="col-md-9">
	       		<input type="text" class="form-control" name="zip" required value="<?php echo $zip; ?>">
	       	</div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="control-label col-sm-3">Mobile</label>
	        <div class="col-md-9">
	        	<input type="phone" class="form-control" name="mobile" value="<?php echo $mobile; ?>">
	        	<span class="glyphicon glyphicon-phone form-control-feedback"></span>
	        </div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="control-label col-sm-3">Phone</label>
	        <div class="col-md-9">
	        	<input type="phone" class="form-control" name="phone" value="<?php echo $phone; ?>">
	        	<span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
	        </div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="control-label col-sm-3">Email</label>
	        <div class="col-md-9">
		        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
		        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		        <br>
		        <button class="btn btn-primary">Submit</button>
		    </div>
	      </div>
	    </form>
	</div>
</div>

<?php include "includes/footer.php"; ?>

<script>

$(document).ready(function() {
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
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});
})

</script>