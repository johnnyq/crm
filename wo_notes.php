<?php

include("config.php");
include("includes/check_login.php");

if(isset($_GET['id'])){

    $id = $_GET['id'];
      
	$sql = mysql_query("SELECT * FROM users, work_order_notes
		WHERE users.user_id = work_order_notes.employee
		AND work_order_id = $id
		AND work_order_notes.active = 1
		ORDER BY work_order_note_id DESC
	");

	$num = mysql_num_rows($sql);
	if($num == 0){
		echo "No Notes";
	}else{

	while ($row = mysql_fetch_array($sql)){
		$work_order_note_id = $row['work_order_note_id'];
		$note = $row['note'];
		$human_time =  human_time($row['date_added']);
		$date_posted =  date('D', $row['date_added']);
		$time_posted = date('g:i A', $row['date_added']);
		$date_modified = date('D g:i A', $row['date_modified']);
		$user_id = $row['employee'];
		$username = ucwords($row['username']);
		$avatar = $row['avatar'];
		if ($avatar == '') {
			$avatar = "img/avatar/anon.png";
		};

?>
<div class="row" id="workOrderNote_<?php echo $work_order_note_id; ?>">
	<div class="col-md-1" align="center">
		<img class="img-circle" src='<?php echo "$avatar"; ?>' height='48' width='48'>
		<small class="text-muted"><?php echo "$username"; ?></small>
	</div>
	<div class="col-md-11" id="workOrderNoteCol2_<?php echo $work_order_note_id; ?>">
    		<?php if($session_user_id == $user_id){ ?>
    		<div class='btn-group pull-right'>
				<button class="btn btn-default btn-sm" id="edit_<?php echo $work_order_note_id; ?>"><span class="glyphicon glyphicon-edit"></span></button>
				<button class="btn btn-default btn-sm" id="delete_<?php echo $work_order_note_id; ?>"><span class="glyphicon glyphicon-trash"></span></button>
			</div>
			<?php } ?>
	    	<p id="noteHolder_<?php echo $work_order_note_id; ?>"><?php echo "$note"; ?></p>
	    	<small class='text-muted'><span class="glyphicon glyphicon-time"></span> <?php echo "$human_time"; ?></small>
	    	
	    	<?php if($date_modified != 0){ ?>
	    		<br><small class='text-muted'><span class="glyphicon glyphicon-time"></span> <?php echo "$date_modified"; ?></small>
	    	<?php } ?>
	    	<hr>   
	</div>
	<div class="col-md-11 hide" id="workOrderNoteEditCol2_<?php echo $work_order_note_id; ?>">
	    	<textarea id="note_<?php echo $work_order_note_id; ?>" class="form-control input-lg"><?php echo "$note"; ?></textarea>
	    	<br>
	    	<small class='text-muted pull-left'><span class="glyphicon glyphicon-time"></span> <?php echo "$human_time"; ?></small>
	    	<div class='btn-group pull-right'>
				<button class="btn btn-default btn-sm" id="cancelEdit_<?php echo $work_order_note_id; ?>"><span class="glyphicon glyphicon-remove"></span></button>
				<button class="btn btn-default btn-sm" id="submitEdit_<?php echo $work_order_note_id; ?>"><span class="glyphicon glyphicon-ok"></span></button>
			</div>
			<br>
	    	<hr>   
	</div>
</div>

<?php 
	
	} //End While
 } //END num rows = 0
} //End Isset

?>

<script>

$(document).ready(function() {

	$( '[id^="delete_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		deleteWorkOrderNote(id);
	});

	$( '[id^="edit_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		editWorkOrderNote(id);
	});

	$( '[id^="cancelEdit_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		cancelEdit(id);
	});

	$( '[id^="submitEdit_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		processEditWorkOrderNote(id);
	});

	function deleteWorkOrderNote(id){	
		$.ajax({
	    	url: "post.php?delete_work_order_note="+id+"",       
		}).success(function(response) {
	  		$( "#workOrderNote_"+id ).slideUp( "slow", function() {
			});
		});
	}

	function editWorkOrderNote(id){	
		$( "#workOrderNoteCol2_"+id ).addClass("hide");
		$( "#workOrderNoteEditCol2_"+id ).removeClass("hide");
		$( "#workOrderNoteEditCol2_"+id ).hide();
		$( "#workOrderNoteEditCol2_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelEdit(id){
		$( "#workOrderNoteEditCol2_"+id ).addClass("hide");
		$( "#workOrderNoteCol2_"+id ).removeClass("hide");
		$( "#workOrderNoteCol2_"+id ).hide();
		$( "#workOrderNoteCol2_"+id ).fadeIn( "slow", function() {});
		
	}

	function processEditWorkOrderNote(id){	
		var note = $( "#note_"+id ).val();
		$.ajax({
	    	url: "post.php?edit_work_order_note="+id+"&note="+note+"",       
		}).success(function(response) {
	  		cancelEdit(id);
	  		$( "#noteHolder_"+id ).html($( "#note_"+id ).val());
		});
	}
})

</script>