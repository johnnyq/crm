<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>

<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="search_users.php">Admin</a></li>
  <li><a href="search_users.php">Users</a></li>
  <li class="active">Add User</li>
</ol>    

<div id="response"></div>

<form id="ajaxform" class="form col-md-4" autocomplete="off">
  <input type="hidden" name="add_user">
  <div class="form-group has-feedback">
    <label>Username</label>
    <input type="text" class="form-control input-lg" name="username" autofocus required>
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <label>Password</label>
    <input type="password" class="form-control input-lg" name="password" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <label>Email</label>
    <input type="email" class="form-control input-lg" name="email">
  	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control input-lg" name="first_name" required>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control input-lg" name="last_name" required>
  </div>
  <div class="form-group">
    <label>Location</label>
    <select class="form-control input-lg" name="location" required>
   		<option></option>
   		
   		<?php
   			
   			$sql = mysql_query("SELECT * FROM locations ORDER BY location ASC");
			while($row = mysql_fetch_array($sql)){
				$location_id = $row['location_id'];
                $location = $row['location'];

            	echo "<option value='$location_id'>$location</option>";
            }

        ?>
    </select>
  </div>
   <div class="form-group">
    <label>Access Level</label>
    <select class="form-control input-lg" name="security_level" required>
    	<option value="0">Inactive</option>
    	<option value="1" selected>User</option>
    	<option value="2">Admin</option>
    </select>
    <br>
    <button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Add</button>
  </div>
</form>

<?php include "includes/footer.php"; ?>

<script>

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
	            $('#ajaxform').trigger("reset");
	    		$("form:not(.filter) :input:visible:enabled:first").focus();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

</script>