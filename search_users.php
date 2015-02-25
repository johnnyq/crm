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

	$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM  users, locations WHERE users.location = locations.location_id AND (username LIKE '%$q%' OR locations.location LIKE '%$q%') LIMIT $record_from, $record_to");

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
				<a class="btn btn-primary pull-right" href='add_user.php'><span class="glyphicon glyphicon-plus"></span></a>
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
	            <th><span class="glyphicon glyphicon-user"></span> User</th>
				<th><span class="glyphicon glyphicon-lock"></span> Access</th>
				<th><span class="glyphicon glyphicon-home"></span> Location</th>
				<th><span class="glyphicon glyphicon-time"></span> Date Added</th>
				<th><span class="glyphicon glyphicon-th"></span> Action</th>
			</tr>
		</thead>
	    <tbody>
			
	        <?php

				while($row = mysql_fetch_array($sql)){
					$id = $row['user_id'];
	                $username = ucwords($row['username']);
	                $user_first_name = ucwords($row['user_first_name']);
	                $user_last_name = ucwords($row['user_last_name']);
	                $location = ucwords($row['location']);
	                $date_added = date('g:ia D M j Y ',$row['user_date_added']);
	                $security_level = $row['security_level'];
	                if($security_level == 0){
	                	$security_level = "<div class='text-danger'><b>Deactivated</b></div>";
	                }elseif($security_level == 1){
	                	$security_level = "User";
	                }else{
	                	$security_level = "Admin";
	                }

	                echo "
						<tr id='tr_$id'>
							<td>$username<br><small class='text-muted'>$user_first_name $user_last_name</small></td>
							<td>$security_level</td>
							<td>$location</td>
							<td>$date_added</td>
							<td>
								<div class='btn-group'>
								    <a class='btn btn-default' href='edit_user.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
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
		    url: "post.php?delete_user="+id+"",       
		}).success(function(response) {
		    $('#tr_'+id).addClass("danger");
		    $( "#tr_"+id ).fadeOut();
		    $("#response").html(response);
		    $("form:not(.filter) :input:visible:enabled:first").focus();
		});
	});

</script>