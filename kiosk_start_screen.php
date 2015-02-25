<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
?>
	    
<div class="jumbotron">
  <h1>Welcome to ComputerWorks</h1>
  <h3>Have you?</h3>
  <h3>
	  <ul>
	  	<li class="text-info">Bought a computer from us?</li>
	  	<li class="text-danger">Had your computer serviced by us?</li>
	  </ul>
  </h3>
  <br>
  <p><a class="btn btn-primary btn-lg" role="button">Yes</a> <a href='add_customer_2.php' class="btn btn-danger btn-lg" role="button">No, I am a new Customer</a></p>
</div>

<div class="row">
	<div class="col-md-4">
	  <h2>Refurb Process</h2>
	  <p>Computers go through a rigervous check.</p>
	  <p><a class="btn btn-default" href="#" role="button">Learn More &raquo;</a></p>
	  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
		    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
		    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
		    <div class="item active">
		      <img src="http://photos-g.ak.fbcdn.net/hphotos-ak-ash2/t1.0-0/c0.59.720.421/s480x480/270532_10150699796980596_3168843_n.jpg" alt="...">
		      <div class="carousel-caption">
		        ...
		      </div>
		    </div>
		    <div class="item">
		      <img src="http://photos-h.ak.fbcdn.net/hphotos-ak-frc3/t1.0-0/c0.59.720.421/s480x480/263089_10150699797115596_1184771_n.jpg" alt="...">
		      <div class="carousel-caption">
		        ...
		      </div>
		    </div>
		    ...
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
		    <span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
		    <span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
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