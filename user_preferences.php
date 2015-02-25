<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
	  	
  	$sql = mysql_query("SELECT * FROM users WHERE user_id = $session_user_id");

  	$row = mysql_fetch_array($sql);
  	$username = $row['username'];
  	$password = $row['password'];
  	$avatar = $row['avatar'];
  	$email = $row['user_email'];
	$start_page = $row['start_page'];	
?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="glyphicon glyphicon-cog"></i> User Preferences</h3>
	</div>
	<div class="panel-body">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li class="active">User Preferences</li>
		</ol>    
	    
	    <div id="response"></div>

	    <form id="ajaxform" class="form col-md-4" autocomplete="off">
	      <input type="hidden" name="change_user_preferences">
	      <input type="hidden" name="id" value="<?php echo $session_user_id; ?>">
	      <div class="form-group has-feedback">
		    <label>Username</label>
		    <input type="text" class="form-control" name="username" value="<?php echo "$username"; ?>">
		  	<span class="glyphicon glyphicon-user form-control-feedback"></span>
		  </div>
	      <div class="form-group has-feedback">
		    <label>Email</label>
		    <input type="email" class="form-control" name="email" value="<?php echo "$email"; ?>">
		  	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		  </div>
	      <div class="form-group has-feedback">
	        <label>Password</label>
	        <input type="password" class="form-control" name="password" value="<?php echo "$password"; ?>" required>
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
	        <label>Avatar</label>
	        <input type="text" class="form-control" name="avatar" value="<?php echo "$avatar"; ?>" required>
	        <span class="glyphicon glyphicon-picture form-control-feedback"></span>
	      	<br>
	      	<img class='img-thumbnail' src="<?php echo $avatar; ?>">
	      </div>
	      <div class="form-group">
	        <label>Start Page</label>
	        <select name="start_page" class="form-control" name="start_page">
	        	<option <?php if($start_page == 'dashboard.php'){ echo "selected = 'selected'"; } ?> value='dashboard.php'>Dashboard</option>
	        	<option <?php if($start_page == 'computers.php'){ echo "selected = 'selected'"; } ?> value='computers.php'>Computers</option>
	        	<option <?php if($start_page == 'customers.php'){ echo "selected = 'selected'"; } ?> value='customers.php'>Customers</option>
	       		<option <?php if($start_page == 'work_orders.php'){ echo "selected = 'selected'"; } ?> value='work_orders.php'>Work Orders</option>
	       	</select>
	        <br>
	        <button class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Update</button>
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
	    e.preventDefault();
	});
})

</script>