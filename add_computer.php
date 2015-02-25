<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>
<ol class="breadcrumb">
  <li><a href="index.php">Home</a></li>
  <li><a href="computers.php">Computers</a></li>
  <li class="active">Add Computer</li>
</ol>    

<div id="response"></div>
<div class="col-md-5">
    <form id="ajaxform" class="form-horizontal" autocomplete="off">
      <input type="hidden" name="add_computer">
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">System</label>
        <div class="col-sm-9">
        	<input type="text" class="form-control input-lg" name="system_number" id="systemNumber" required>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Type</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="type" autofocus required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'computer_type' ORDER BY value ASC");
					while($row = mysql_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Make</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="make" required>
	       		<option></option>	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'make' ORDER BY value ASC");
					while($row = mysql_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Model</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="model" required>
	    </div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Serial</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="serial" id="serial" required>
	        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
	    	<div id="dupSerial"></div>
	    </div>

      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">OS</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="os" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'os' ORDER BY value ASC");
					while($row = mysql_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">COA</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="coa">
	    </div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Processor</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="processor" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'processor' ORDER BY value ASC");
					while($row = mysql_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Memory</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="memory" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'memory' ORDER BY ABS(value) ASC");
					while($row = mysql_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option>$value</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group">
        <label class="control-label col-sm-3">Hard Drive</label>
        <div class="col-sm-9">
	        <select class="form-control input-lg" name="hard_drive" required>
	       		<option></option>
	       		
	       		<?php
	       			
	       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'harddrive' ORDER BY ABS(value) ASC");
					while($row = mysql_fetch_array($sql)){
		                $value = $row['value'];

		            	echo "<option value='$value'>$value GB</option>";
		            }

		        ?>
		    </select>
		</div>
      </div>
      <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Price</label>
        <div class="col-sm-9">
	        <input type="text" class="form-control input-lg" name="price" required>
	        <br>
	        <button class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-ok"></span> Add</button>
	    </div>
      </div>
    </form>
</div>
<div class="col-md-7">
	<div class="panel panel-default">
		<div class="panel-heading">
			Computer Templates
		</div>
		<div class="panel-body">
			<ul class="nav nav-pills nav-justified">
			  <li class="active"><a href="#" id="btnLaptops">Laptops</a></li>
			  <li><a href="#" id="btnDesktops">Desktops</a></li>
			  <li><a href="#">All In One</a></li>
			</ul>
			<hr>

			<div id="computerTemplates"></div>

			<div align="center" id="previewLabel"></div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>

<script>

$(document).ready(function() {
		
	generateSystemNumber();
	loadComputerTemplates();

	$("#btnLaptops").click(function() {
		$.ajax({
	    	url: "computer_templates.php?type=Laptop",      
		}).success(function(response) {
			$("#computerTemplates").html(response); 		
		});
	});

	$("#btnDesktops").click(function() {
		$.ajax({
	    	url: "computer_templates.php?type=Desktop",      
		}).success(function(response) {
			$("#computerTemplates").html(response); 		
		});
	});

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
	            generateSystemNumber();
	            var responseArray = response.split("|");
	            $("#response").html(responseArray[0]);
	            var computerId = responseArray[1];
	            loadDemoLabel(computerId);
	            $("input[name=serial]").val("");
	    		$("input[name=serial]").focus();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	function generateSystemNumber(){
		$.ajax({
    	url: "generate_system_number.php"       
		}).success(function(response) {
	  		$( "#systemNumber" ).val(response);
		});

	}

	function loadComputerTemplates(){
    	$.ajax({
	    	url: "computer_templates.php",      
		}).success(function(response) {
			$("#computerTemplates").html(response); 		
		});
    }

    $("#serial").keyup(function(){
		var q = $("#serial").val();
		$.ajax({
		    url: "check_dup_serial.php?q="+q+"",      
		}).success(function(response) {
		    $("#dupSerial").html(response);
		});		
	});

})

</script>