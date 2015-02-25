<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="customers.php">Customers</a></li>
  <li class="active">Add Customer</li>
</ol>    

<div id="response"></div>

<div class="col-sm-5">
    <form id="ajaxform" class="form-horizontal" autocomplete="off">
      <input type="hidden" name="add_customer">
       <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Company</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="company">
	    </div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">First Name</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="first_name" required>
	    </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Last Name</label>
        <div class="col-sm-9">
        	<input type="text" class="form-control input-lg" name="last_name" required>
        </div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Address</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="address" required>
	    </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">City</label>
        <div class="col-sm-9">
        	<input type="text" class="form-control input-lg" name="city" required>
       	</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">State</label>
        <div class="col-sm-9">
        	<input type="text" class="form-control input-lg" name="state" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Zip Code</label>
        <div class="col-sm-9">
        	<input type="text" class="form-control input-lg" name="zip" required>
        </div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Mobile</label>
        <div class="col-sm-9">
	        <input type="phone" class="form-control input-lg" name="mobile">
       	</div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Phone</label>
        <div class="col-sm-9">
	        <input type="phone" class="form-control input-lg" name="phone">
       	</div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Email</label>
        <div class="col-sm-9">
	        <input type="email" class="form-control input-lg" name="email">
	        <br>
	        <button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Add</button>
	    </div>
      </div>
    </form>
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