<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";
  
	if(isset($_GET['id'])){
		$computer_id = $_GET['id'];
	}

	$sql = mysql_query("SELECT * FROM computers WHERE computer_id = $computer_id");

	$row = mysql_fetch_array($sql);
    $system_number = $row['system_number'];
    $type = ucwords($row['type']);
    $make = ucwords($row['make']);
    $model = ucwords($row['model']);
    $serial = $row['serial'];
    $os = $row['os'];
    $coa = $row['coa'];
    $processor = $row['processor'];
    $hard_drive = $row['hard_drive'];
    $memory = $row['memory'];
    $price = $row['price'];
    $status = $row['status'];

?>
	    
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Editing Computer</h3>
	</div>
	<div class="panel-body">
	    <ol class="breadcrumb">
		  <li><a href="index.php">Home</a></li>
		  <li><a href="computers.php">Computers</a></li>
		  <li class="active">Edit Computer</li>
		</ol>    

	    <div id="response"></div>

	    <form id="ajaxform" class="form-horizontal col-md-5" autocomplete="off">
	      <input type="hidden" name="edit_computer">
	      <input type="hidden" name="id" value="<?php echo $computer_id; ?>">
	      <div class="form-group has-feedback">
	        <label class="col-sm-3">System</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="system_number" value="<?php echo $system_number; ?>" required>
		        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Type</label>
	        <div class="col-md-9">
		        <select class="form-control" name="type" autofocus required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'computer_type' ORDER BY value ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($type == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Make</label>
	        <div class="col-md-9">
		        <select class="form-control" name="make" required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'make' ORDER BY value ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($make == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="col-sm-3">Model</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="model" value="<?php echo $model; ?>" required>
		        <span class="glyphicon glyphicon-tag form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="col-sm-3">Serial</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="serial" value="<?php echo $serial; ?>" required>
		        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Operating System</label>
	        <div class="col-md-9">
		        <select class="form-control" name="os" required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'os' ORDER BY value ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($os == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="col-sm-3">COA</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="coa" value="<?php echo $coa; ?>" required>
		        <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
		    </div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Processor</label>
	        <div class="col-md-9">
		        <select class="form-control" name="processor" required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'processor' ORDER BY value ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($processor == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Memory</label>
	        <div class="col-md-9">
		        <select class="form-control" name="memory" required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'memory' ORDER BY ABS(value) ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($memory == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Hard Drive</label>
	        <div class="col-md-9">
		        <select class="form-control" name="hard_drive" required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'harddrive' ORDER BY ABS(value) ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($hard_drive == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group">
	        <label class="col-sm-3">Status</label>
	        <div class="col-md-9">
		        <select class="form-control" name="status" required>
		       		
		       		<?php
		       			
		       			$sql = mysql_query("SELECT * FROM commons WHERE category = 'computer_status' ORDER BY value ASC");
						while($row = mysql_fetch_array($sql)){
			                $value = $row['value'];

			               	if($status == $value){
								echo "<option selected='selected'>$value</option>";
							}else{
								echo "<option>$value</option>";
							}			
			            }

			        ?>

			    </select>
			</div>
	      </div>
	      <div class="form-group has-feedback">
	        <label class="col-sm-3">Price</label>
	        <div class="col-md-9">
		        <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" required >
		        <span class="glyphicon glyphicon-shopping-cart form-control-feedback"></span>
		        <br>
		        <button class="btn btn-primary">Submit</button>
		    </div>
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
	    e.preventDefault(); //STOP default POST action
	});
})

</script>