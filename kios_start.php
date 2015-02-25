<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="jumbotron">
  <h1>Welcome to ComputerWorks</h1>
  <p><a class="btn btn-primary btn-lg" role="button">Make<br>a Request</a> <a href='add_customer_2.php' class="btn btn-danger btn-lg" role="button">Check On your<br>Work Order</a> <a href='add_customer_2.php' class="btn btn-danger btn-lg" role="button">Tell Us about<br>your Experiance</a> <a href='add_customer_2.php' class="btn btn-danger btn-lg" role="button">New<br>Customer</a></p>
</div>

<div class="row">
	<div class="col-md-4">
	  <h2>Refurb Process</h2>
	  <p>Computers go through a rigervous check.</p>
	  <p><a class="btn btn-default" href="#" role="button">Learn More &raquo;</a></p>
	</div>
	<div class="col-md-4">
	  <h2>Our Service</h2>
	  <p>No appointments, no long waits. Get answers quick and efficiently from our A+ Certified Technicians</p>
	  <p><a class="btn btn-default" href="#" role="button">Learn More &raquo;</a></p>
	</div>
	<div class="col-md-4">
	  <h2>Our Guarantee</h2>
	  <p>When you buy a computer from us we will support it for the lifetime of the machine</p>
	  <p><a class="btn btn-default" href="#" role="button">Learn More &raquo;</a></p>
	</div>
</div>

<hr>

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
	    e.preventDefault(); //STOP default POST action
	});

</script>