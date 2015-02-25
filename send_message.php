<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>

<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="messages.php">Messages</a></li>
  <li class="active">Sending Message</li>
</ol>    

<div id="response"></div>

<div class="col-sm-5">

	<form id="ajaxform" class="form-horizontal" autocomplete="off">
	  <input type="hidden" name="send_message">
	  <div class="form-group">
	    <label class="control-label col-sm-3">To</label>
	    <div class="col-sm-9">
	        <select class="form-control input-lg" name="message_to" autofocus required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM users WHERE security_level > 0 ORDER BY username ASC");
					while($row = mysql_fetch_array($sql)){
		                $user_id = $row['user_id'];
		                $username = ucwords($row['username']);

		            	echo "<option value='$user_id'>$username</option>";
		            }

		        ?>
		    </select>
		</div>
	  </div>
	  
	  <div class="form-group has-feedback">
	    <label class="control-label col-sm-3">Message</label>
	    <div class="col-sm-9">
	        <textarea class="form-control input-lg" rows='5' name="message" required></textarea>
	        <br>
	        <button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-send"></span> Send</button>
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