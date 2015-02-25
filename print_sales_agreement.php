<?php 
	
include "config.php";
include "includes/header.php"; 
include "includes/check_login.php";
include "includes/nav.php";

if(isset($_GET['id'])){
	$id = $_GET['id'];
}

$sql = mysql_query("SELECT * FROM users, computer_sales, customers, computers
	WHERE computer_sales.employee_id = users.user_id
	AND computer_sales.computer_id = computers.computer_id
	AND computer_sales.customer_id = customers.customer_id
	AND sale_id = $id"
);

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
$user_first_name = ucwords($row['user_first_name']);   
$warranty = $row['warranty'];
$sale_date = date('M d, Y',$row['sale_date']);
$sale_time = date('h:i A',$row['sale_date']);
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
		<center><h1>Sales Agreement</h1></center>
	</div>
</div>
<div class="row">
	<div class="col-xs-8">
		<?php 
		echo "
			<h4>$first_name $last_name <small>$company</small></h4>
			<address>$address $city $state $zip<br>$email<br>$phone</address>
		";
		?>
	</div>
	<div class="col-xs-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Sale Details</h3>
			</div>
			<table class="table">
				<tr>
					<th>Sale #</th>
					<td><?php echo $id; ?></td>
				</tr>
				<tr>
					<th>Date</th>
					<td><?php echo "$sale_date $sale_time"; ?></td>
				</tr>
				<tr>
					<th>Sales Rep</th>
					<td><?php echo $user_first_name; ?></td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Computers Bought</h3>
			</div>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>COMPUTER</th>
						<th>SERIAL</th>
						<th>WARRANTY</th>
						<th>PRICE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo "$make $model $type ($os)<br>$processor/$memory MB/$hard_drive GB"; ?></td>
						<td><?php echo "$system_number<br>$serial<br"; ?></td>
						<td><?php echo "$warranty Days"; ?></td>
						<td><?php echo "$$price"; ?></td>
					</tr>
				</tbody>
			</table>
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
				<small><?php echo $warranty_info; ?></small>	
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
				<?php echo $return_policy; ?>
			</div>
		</div>
		<center><?php echo $work_order_footer; ?></center>
	</div>
</div>
	
<?php include "includes/footer.php"; ?>