<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">New Customer</h3>
	</div>
	<div class="panel-body">

	    <div id="response"></div>

	    <div class="col-sm-6">
		    <form id="ajaxform" class="form-horizontal" autocomplete="off">
		      <input type="hidden" name="add_customer">
		       <div class="form-group form-group-lg has-feedback">
		        <label class="control-label col-sm-3">Company</label>
		        <div class="col-sm-9">
			        <input type="text" class="form-control" name="company">
			        <span class="glyphicon glyphicon-briefcase form-control-feedback"></span>
			    </div>
		      </div>
		      <div class="form-group form-group-lg has-feedback">
		        <label class="control-label col-sm-3">First Name</label>
		        <div class="col-sm-9">
			        <input type="text" class="form-control" name="first_name" required>
			        <span class="glyphicon glyphicon-user form-control-feedback"></span>
			    </div>
		      </div>
		      <div class="form-group form-group-lg">
		        <label class="control-label col-sm-3">Last Name</label>
		        <div class="col-sm-9">
		        	<input type="text" class="form-control" name="last_name" required>
		        </div>
		      </div>
		      <div class="form-group form-group-lg has-feedback">
		        <label class="control-label col-sm-3">Address</label>
		        <div class="col-sm-9">
			        <input type="text" class="form-control" name="address" required>
			        <span class="glyphicon glyphicon-map-marker form-control-feedback"></span>
			    </div>
		      </div>
		      <div class="form-group form-group-lg">
		        <label class="control-label col-sm-3">City</label>
		        <div class="col-sm-9">
		        	<input type="text" class="form-control" name="city" required>
		       	</div>
		      </div>
		      <div class="form-group form-group-lg">
		        <label class="control-label col-sm-3">State</label>
		        <div class="col-sm-9">
		        	<input type="text" class="form-control" name="state" required>
		        </div>
		      </div>
		      <div class="form-group form-group-lg">
		        <label class="control-label col-sm-3">Zip Code</label>
		        <div class="col-sm-9">
		        	<input type="text" class="form-control" name="zip" required>
		        </div>
		      </div>
		      <div class="form-group form-group-lg has-feedback">
		        <label class="control-label col-sm-3">Mobile</label>
		        <div class="col-sm-9">
			        <input type="phone" class="form-control" name="mobile">
			        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
		       	</div>
		      </div>
		      <div class="form-group form-group-lg has-feedback">
		        <label class="control-label col-sm-3">Phone</label>
		        <div class="col-sm-9">
			        <input type="phone" class="form-control" name="phone">
			        <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
		       	</div>
		      </div>
		      <div class="form-group form-group-lg has-feedback">
		        <label class="control-label col-sm-3">Email</label>
		        <div class="col-sm-9">
			        <input type="email" class="form-control" name="email">
			        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			        <br>
			        <button class="btn btn-lg btn-primary">Submit</button>
			    </div>
		      </div>
		    </form>
		</div>
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