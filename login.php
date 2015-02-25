<?php 
	
	include "config.php";
	include "includes/header.php"; 
?>	

<div class="row">
  <div class="col-md-offet-3 col-md-6 col-md-offset-3">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2><?php echo $login_banner; ?></h2>
      </div>
      <div class="panel-body">
        <div id="response"></div>
  		<div id="avatar"></div>
        <form class="form-horizontal" id="loginForm" autocomplete="off">
          <input type="hidden" name="login">
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group" id="inputUser">
                <span class="input-group-addon input-lg"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Username or Email" required autofocus>                                        
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon input-lg"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password">
              </div>
              <br>
              <button class="btn btn-primary btn-lg btn-block"><i class="glyphicon glyphicon-log-in"></i> Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include "includes/footer.php"; ?>

<script>

$(document).ready(function() {
	
	$("#loginForm").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "login_ajax.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	$("#username").keyup(function(){
		var q = $("#username").val();
		query(q);	
	});

	function query(q){
		$.ajax({
		    url: "get_avatar.php?q="+q+"",      
		}).success(function(response) {
		    $("#avatar").html(response);
		});
	}
})

</script>