<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Add Make</h3>
	</div>
	<div class="panel-body">
		<ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="search_users.php">Admin</a></li>
		  <li><a href="search_makes.php">Make</a></li>
		  <li class="active">Add Make</li>
		</ol>    
	    
	    <div id="response"></div>

	    <form id="ajaxform" class="form col-md-4" autocomplete="off">
	      <input type="hidden" name="add_make">
	      <div class="form-group has-feedback">
	        <label>Make</label>
	        <input type="text" class="form-control input-lg" name="make" autofocus required>
	        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
	        <br>
	        <button class="btn btn-primary btn-lg">Submit</button>
	      </div>
	    </form>
	</div>
</div>

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