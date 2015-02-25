<?php

include "config.php";
include "includes/check_login.php";

if(isset($_GET['id'])){
	$id = intval($_GET['id']);

$sql = mysql_query("SELECT * FROM customer_notes, users 
			WHERE customer = $id
			AND users.user_id = customer_notes.employee
			AND customer_notes.active = 1
			ORDER BY customer_note_id DESC"
		);
	
	$num = mysql_num_rows($sql);
	if($num>0){

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-edit"></i> Notes <span class="badge pull-right"><?php echo "$num"; ?></span></h3>
	</div>
	<div class="panel-body">
			<?php
				
				while ($row = mysql_fetch_array($sql)){
					$customer_note_id = $row['customer_note_id'];
			  		$date_added = date($date_format, $row['date_added']);
					$note = $row['note'];
			    	$username = ucwords($row['username']);
			    	$avatar = $row['avatar'];
					if ($avatar == '') {
						$avatar = "https://yt3.ggpht.com/-iMoJ9-88hnU/AAAAAAAAAAI/AAAAAAAAAAA/QNmG6UlBDa4/s48-c-k-no/photo.jpg";
					};
			    	echo "
			    		<div class='row' id='note_$customer_note_id'>
							<div class='col-md-1' align='center'>
								<img class='img-circle' src='$avatar' height='48' width='48'>
								<small class='text-muited'>$username</small>
							</div>
							<div class='col-md-11' id='noteCol2_$customer_note_id'>
					    		<div class='btn-group pull-right'>
									<a class='btn btn-default btn-sm' id='edit_$customer_note_id'><span class='glyphicon glyphicon-edit'></span></a>
									<a class='btn btn-default btn-sm' id='delete_$customer_note_id'><span class='glyphicon glyphicon-trash'></span></a>
								</div>	
						    	<p id='noteHolder_$customer_note_id'>$note</p>
						    	<small class='text-muted'><span class='glyphicon glyphicon-time'></span> $human_time $date_added</small>
						    	<hr>
							</div>
							<div class='col-md-11 hide' id='noteEditCol2_$customer_note_id'>
								<textarea id='txtNote_$customer_note_id' class='form-control input-lg'>$note</textarea>
								<br>
								<small class='text-muted pull-left'><span class='glyphicon glyphicon-time'></span> $human_time $date_added</small>
	    						<div class='btn-group pull-right'>
									<button class='btn btn-default btn-sm' id='cancelEdit_$customer_note_id'><span class='glyphicon glyphicon-remove'></span></button>
									<button class='btn btn-default btn-sm' id='submitEdit_$customer_note_id'><span class='glyphicon glyphicon-ok'></span></button>
								</div>
								<br>
	    						<hr>
	    					</div>
						</div>
					";
				}
				$count = mysql_num_rows($sql);

	} //End if no records found for Notes
?>
	</div>
</div>

<?php 

}

?>