<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
	  	$id = $_GET['id'];
	  	
	  	$sql = mysql_query("SELECT * FROM users WHERE user_id = $id");

	  	$row = mysql_fetch_array($sql);
	  	$username = $row['username'];
	  	$password = $row['password'];
	  	$email = $row['user_email'];
	  	$first_name = $row['user_first_name'];
	  	$last_name = $row['user_last_name'];
	  	$security_level = $row['security_level'];
	  	$avatar = $row['avatar'];
	  	$location_id = $row['location_id'];
	}

?>
	    
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="search_users.php">Admin</a></li>
  <li><a href="search_users.php">Users</a></li>
  <li class="active">Edit User</li>
</ol>

<div id="response"></div>

<form id="ajaxform" class="form col-md-4" autocomplete="off">
  <input type="hidden" name="edit_user">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group has-feedback">
    <label>Username</label>
    <input type="text" class="form-control input-lg" name="username" value="<?php echo "$username"; ?>" autofocus required>
    <span class="glyphicon glyphicon-user form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <label>Password</label>
    <input type="password" class="form-control input-lg" name="password" value="<?php echo "$password"; ?>" required>
    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
  </div>
  <div class="form-group has-feedback">
    <label>Email</label>
    <input type="email" class="form-control input-lg" name="email" value="<?php echo "$email"; ?>">
  	<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
  </div>
  <div class="form-group">
    <label>First Name</label>
    <input type="text" class="form-control input-lg" name="first_name" value="<?php echo "$first_name"; ?>" required>
  </div>
  <div class="form-group">
    <label>Last Name</label>
    <input type="text" class="form-control input-lg" name="last_name" value="<?php echo "$last_name"; ?>" required>
  </div>
  <div class="form-group">
    <label>Avatar</label>
    <input type="text" class="form-control input-lg" name="avatar" value="<?php echo "$avatar"; ?>" required>
  </div>
  <div class="form-group">
    <label>Access Level</label>
    <select class="form-control input-lg" name="security_level" required>
    	<option <?php if($security_level == 0){ echo "selected = 'selected'"; } ?> value="0">Deactived</option>
    	<option <?php if($security_level == 1){ echo "selected = 'selected'"; } ?> value="1">User</option>
    	<option <?php if($security_level == 2){ echo "selected = 'selected'"; } ?> value="2">Admin</option>
    </select>
  </div>
  <div class="form-group">
    <label>Location</label>
    <select class="form-control input-lg" name="location" required>
   		
   		<?php
   			
   			$sql = mysql_query("SELECT * FROM locations ORDER BY location ASC");
			while($row = mysql_fetch_array($sql)){
				$location_id_2 = $row['location_id'];
                $location = $row['location'];
                
				if($location_id == $location_id_2){
					echo "<option value='$location_id_2' selected='selected'>$location</option>";
				}else{
					echo "<option value='$location_id_2'>$location</option>";
				}			
            }

        ?>
    
    </select> 
    <br>
    <button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Update</button>
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
	        }, 	
	    });
	    e.preventDefault();
	});

</script>