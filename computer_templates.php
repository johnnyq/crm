<div class="row">

<?php
//include("includes/header.php");
include("config.php");

if(isset($_GET['type'])){
    $type = $_GET['type'];

	$sql = mysql_query("SELECT * FROM computer_templates WHERE type = '$type' ORDER BY computer_template_id DESC");

	$num = mysql_num_rows($sql);
	while ($row = mysql_fetch_array($sql)){
		$computer_template_id = $row['computer_template_id'];
		$type = $row['type'];
		$make = $row['make'];
		$model = $row['model'];
		$os = $row['os'];
		$processor = $row['processor'];
		$memory = $row['memory'];
		$hard_drive = $row['hard_drive'];
		$optical_drive = $row['optical_drive'];
		$price = $row['price'];
		if($type == 'Laptop'){
        	$type = 'fa fa-laptop';
        }elseif($type == 'Desktop'){
        	$type = 'fa fa-desktop';
        }
?>
<div class="col-md-4" align="center">
	<div class="panel panel-default">
		<div class="panel-body">
			<h2><?php echo "<i class='$type'></i>"; ?></h2>
			<p><?php echo "$make $model"; ?><br>
			<?php echo "$processor/$memory/$hard_drive"; ?><br>
			<?php echo "$os"; ?><br>
			<?php echo "$$price"; ?></p>
		</div>
	</div>
</div>

<?php 
	
} //End While
}
?>

</div>