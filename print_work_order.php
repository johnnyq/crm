<?php 
	
include "config.php";
include "includes/header.php"; 
include "includes/check_login.php";
include "includes/nav.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$sql = mysql_query("SELECT * FROM users, customers, work_orders
	WHERE work_orders.take_in_employee = users.user_id
	AND work_orders.customer_id = customers.customer_id
	AND work_order_id = $id"
);

$row = mysql_fetch_array($sql);
$type = $row['type'];
$make = ucwords($row['make']);
$model = ucwords($row['model']);
$type = $row['type'];
$serial = $row['serial'];
$scope = $row['work_order_type'];
$takein_notes = $row['description'];
$user_first_name = ucwords($row['user_first_name']);   
$take_in_date = date('M d, Y',$row['take_in_date']);
$take_in_time = date('h:i A',$row['take_in_date']);
$company = $row['company'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$address = $row['address'];
$city = $row['city'];
$state = $row['state'];
$zip = $row['zip'];
$email = $row['email'];
$phone = $row['phone'];
if(strlen($phone)>2){ 
	$phone = substr($row['phone'],0,3)."-".substr($row['phone'],3,3)."-".substr($row['phone'],6,4);
}
$customer_id = $row['customer_id'];

?>

<div class="row">
	<div class="col-xs-1">
		<img src="http://crm.goodwillcomputerworks.org/img/gwlogogray.png">
	</div>
	<div class="col-xs-11">
		<h3><?php echo $main_company_name; ?></h3>
		<address><?php echo "$main_company_address $main_company_city $main_company_state $main_company_zip<br>$main_company_phone $main_company_website" ?></address>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<center><h1>Work Order <small>Customer Copy</small></h1></center>
	</div>
</div>
<div class="row">
	<div class="col-xs-7">
		<?php 
		echo "
			<h4>$first_name $last_name <small>$company</small></h4>
			<address>$address $city $state $zip<br>$email<br>$phone</address>
		";
		?>
	</div>
	<div class="col-xs-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Bookin Details</h3>
			</div>
			<table class="table">
				<tr>
					<th>WO #</th>
					<td><?php echo $id; ?></td>
				</tr>
				<tr>
					<th>Date</th>
					<td><?php echo "$take_in_date $take_in_time"; ?></td>
				</tr>
				<tr>
					<th>Tech</th>
					<td><?php echo $user_first_name; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-7">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Details</h3>
			</div>
			<table class="table">
				<tr>
					<th><?php echo "$scope"; ?></th>
				</tr>
				<tr>
					<td><?php echo "$takein_notes"; ?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-xs-5">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Assets</h3>
			</div>
			<table class="table">
				<tr>
					<th>Item</th>
					<td><?php echo "$make $model"; ?></td>
				</tr>
				<tr>
					<th>Type</th>
					<td><?php echo "$type"; ?></td>
				</tr>
				<tr>
					<th>Serial</th>
					<td><?php echo "$serial"; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Terms and Conditions</h3>
			</div>
			<div class="panel-body">
				<small><?php echo "$work_order_terms"; ?></small>
			</div>
		</div>
		<center><?php echo $work_order_footer; ?></center>
	</div>
</div>

<?php include "includes/footer.php"; ?>