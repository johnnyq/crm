<?php 
	
include "config.php";
include "includes/header.php"; 
include "includes/check_login.php";
include "includes/nav.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$sql = mysql_query("SELECT * FROM computers WHERE computer_id = $id");

$row = mysql_fetch_array($sql);
$system_number = $row['system_number'];
$type = $row['type'];
$make = ucwords($row['make']);
$model = ucwords($row['model']);
$type = $row['type'];
$serial = $row['serial'];
$os = $row['os'];
$processor = $row['processor'];
$memory = $row['memory'];
$hard_drive = $row['hard_drive'];
$price = $row['price'];

?>

<div class="panel panel-default">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 hero" align="center">
				<h1><?php echo "$make"; ?></h1>
				<h2><?php echo "$model $type"; ?></h2>
				<h1><?php echo "$$price"; ?></h1>
				<h2><?php echo "$os"; ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Specs</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li><?php echo "$processor"; ?></li>
							<li><?php echo "Memory: $memory MB"; ?></li>
							<li><?php echo "Storage Space: $hard_drive GB"; ?></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Qualified Discounts</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li>Senior (55 Older) 10%</li>
							<li>Student 10%</li>
							<li>Military 10$</li>
							<li>Employee 20%</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Warranty</h3>
					</div>
					<div class="panel-body">
						<ul>
							<li>90 Day Free</li>
							<li>1 Year $24.99</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Warranty</h3>
					</div>
					<div class="panel-body">
						<small>
						Warranty does not cover software and or corruption of the operating system due to viruses, malware, user error, installation of programs either intentional or accidental that cause the operating system to become unstable slow or otherwise unusable. A fee will be charged to return the operating system to a usable state. If the unit is still under warranty and it is determined the operating system corruption is due to hardware failure. The fee may be waived. Goodwill ComputerWorks will fix or replace your computer free of charge if there are any problems during the warranty period. The computer may be replaced at Goodwill's discretion. The original dated receipt and sales agreement must be provided. The warranty is void if the case is opened, or any modifications are made to the hardware during the warranty period. The computer warranty requires the computer to be returned to Goodwill Computer Works for any warranty related repairs or adjustments. Only electronic components are repaired or replaced. Broken or damaged parts are not included in the warranty. There is no warranty on laptop batteries or charging systems.
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Return and Exchange Policy</h3>
					</div>
					<div class="panel-body">
						<h5>14 Day Return</h5>
						<small>
						We accept returns 14 days from the original date of purchase on warrantied computers. We will gladly credit, or refund your purchase price. The Goodwill tag must be intact and the original, dated sales slip must be provided.
						</small>
						<h5>15% Restocking Fee</h5>
						<small>
						A 15% restocking fee will be applied to all computers that are returned for a refund or exchange. The Goodwill tag must be intact and the original dated sales slip must be provided for all returns, exchanges, and warranty repair services.
						</small>
						<h5>No Cash Refunds</h5>
						<small>
						Refunds by check or cash will be issued by check from our corporate office after 14 business days (Monday-Friday) from the return date. No refund on labor or installation services.
						</small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include "includes/footer.php"; ?>