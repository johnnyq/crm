<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="glyphicon glyphicon-transfer"></span> Transfer Computer</h3>
	</div>
	<div class="panel-body">
	    
	    <div id="response"></div>

	    <form id="ajaxform" class="form col-md-4" autocomplete="off">
	      <input type="hidden" name="transfer_location">
	      <div class="form-group has-feedback">
	        <label>Transfer to</label>
	        <span class="glyphicon glyphicon-ok form-control-feedback"></span>
	        <select class="form-control input-lg has-feedback" name="location" autofocus required>
	       		<option value=''>- Select a Location -</option>
	       		
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
	      <div class="form-group has-feedback">
	        <label>Scan Serial Number</label>
	        <input type="text" class="form-control input-lg" name="serial" required>
	        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
	        <br>
	        <button class="btn btn-primary btn-lg">Submit</button>
	      </div>
	    </form>

	    <table class="table">
	    	<div id="transfers"></div>
	    </table>

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
	            $("input[name=serial]").val("");
	    		$("input[name=serial]").focus();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

</script>