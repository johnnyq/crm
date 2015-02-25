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

	$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM  users, messages WHERE messages.message_from = users.user_id AND messages.message_to = $session_user_id AND (username LIKE '%$q%' OR messages.message LIKE '%$q%') LIMIT $record_from, $record_to");

	$num = mysql_num_rows($sql);

	$num_rows = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS()"));
	$total_found_rows = $num_rows[0];
    $total_pages = ceil($total_found_rows / 10);

?>

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
				<a class="btn btn-primary pull-right" href='send_message.php'><span class="glyphicon glyphicon-send"></span> New Message</a>
			</div>
		</div>
	</form> 

	<div id="response"></div>

	<?php

	if($total_found_rows > 0) { 

	?>

	<table class="table">	
	    <tbody>
			
	        <?php

				while($row = mysql_fetch_array($sql)){
					$id = $row['user_id'];
	                $username = ucwords($row['username']);
	                $avatar = $row['avatar'];
	                $message = $row['message'];
	                $sent_timestamp = date('g:ia D M j Y ',$row['sent_timestamp']);
	                $ack_timestamp = $row['ack_timestamp'];
	                if($ack_timestamp == 0){
	                	$message = "<p class='text-info'>$message</p>";
	                }

	                echo "
						<tr id='tr_$id'>
							<td><center><img height='64' width='64' src='$avatar'><br>$username</center></td>
							<td><blockquote>$message<small class='text-muted'>$sent_timestamp</blockquote></td>
							<td>
	                            <button id='del_$id' class='btn btn-default'><span class='glyphicon glyphicon-remove'></span></button> 
							</td>
						</tr>
					";
				}
			?>
		
	    </tbody>
	</table>

	<?php

	if($total_found_rows > 20){
	include("includes/pagination.php");
	}
		}else{
			echo "<div class='alert alert-warning'>No messages today.</div>";
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
		    url: "post.php?delete_message="+id+"",       
		}).success(function(response) {
		    $('#tr_'+id).addClass("danger");
		    $( "#tr_"+id ).fadeOut();
		    $("#response").html(response);
		    $("form:not(.filter) :input:visible:enabled:first").focus();
		});
	});

</script>