<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

    if (isset($_GET['p'])){
	    $p = intval($_GET['p']);
	    $record_from = (($p)-1)*10;
	    $record_to =  10;
	}else{
		$record_from = 0;
		$record_to = 10;
		$p = 1;
	}

    if (isset($_GET['q'])){
		$q = $_GET['q'];
	}

	$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM locations WHERE location LIKE '%$q%' ORDER BY location_id DESC LIMIT $record_from, $record_to");

	$num = mysql_num_rows($sql);

	$num_rows = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / 10);

?>
<div class="row">
	<div class="col-md-3">
		<?php include "includes/admin_nav.php"; ?>
	</div>
	<div class="col-md-9">
		<form class="well well-sm" autocomplete="off">
			<div class="row">
				<div class="col-md-4">
					<div class="input-group">
						<input type="text" class="form-control" name="q" value="<?php if(isset($q)){echo $q;} ?>" placeholder="Search Query" autofocus>
						<span class="input-group-btn">
							<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</div>
				<div class="col-md-8">
					<a class="btn btn-primary pull-right" href='add_location.php'><span class="glyphicon glyphicon-plus"></span></a>
				</div>
			</div>
		</form> 

		<div id="response"></div>

		<?php

		if($total_found_rows > 0) { 

		?>

		<table class="table table-bordered table-hover">	
		    <thead>	
		        <tr>	
		            <th><span class="glyphicon glyphicon-home"></span> Location</th>
					<th><span class="glyphicon glyphicon-th"></span> Action</th>
				</tr>
			</thead>
		    <tbody>
				
		        <?php

					while($row = mysql_fetch_array($sql)){
						$id = $row['location_id'];
		                $location = $row['location'];
		                
		                echo "
							<tr id='tr_$id'>
								<td>$location</td>
								<td>
									<div class='btn-group'>
									    <a class='btn btn-default' href='edit_location.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
		                                <button id='del_$id' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button>
		                            </div>
								</td>
							</tr>
						";
					}
				?>
			
		    </tbody>
		</table>

		<?php

		include("includes/pagination.php");
		
			}else{
				echo "<div class='alert alert-warning'>No records found.</div>";
			}

		?>

	</div>
</div>

<?php include "includes/footer.php"; ?>

<script>

	$( '[id^="del_"]' ).click(function() {
		var id = this.id;
 		id = id.split("_");
 		id = id[1];
		
		$.ajax({
		    url: "post.php?delete_location="+id+"",       
		}).success(function(response) {
		    $('#tr_'+id).addClass("danger");
		    $( "#tr_"+id ).fadeOut();
		    $("#response").html(response);
		    $("form:not(.filter) :input:visible:enabled:first").focus();
		    $("#pagei").load();
		});
	});

</script>