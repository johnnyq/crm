<?php 
	
	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

	$tbi = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'To Be Inspected'"));
	$ip = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'In Progress'"));
	$oh = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'On Hold'"));
	$rfc = mysql_num_rows(mysql_query("SELECT * FROM work_orders WHERE work_order_status = 'Ready For Collection'"));

	if (isset($_GET['q'])){
		$q = $_GET['q'];
		$hide = '';
	}else{
		$q = 'To Be Inspected';
		$hide = 'hide';
	}
	
	$sql = mysql_query("SELECT * FROM users, customers, work_orders
			WHERE work_orders.take_in_employee = users.user_id
			AND work_orders.customer_id = customers.customer_id
			AND work_order_status = '$q'
			ORDER BY work_order_id DESC");
	
	$num_rows = mysql_num_rows($sql);

	if ($q == 'To Be Inspected'){
    	$hide = 'hide';
    }else{
    	$hide = '';
    }

?>		
		<ul class="nav nav-tabs nav-justified">
		  <?php if($tbi > 0){ ?><li id="btnTbi"><a href="#To Be Inspected">To Be Inspected <span class="badge pull-right"><?php echo $tbi; ?></span></a></li> <?php } ?>
		  <?php if($ip > 0){ ?><li id="btnIp"><a href="#In Progress">In Progress <span class="badge pull-right"><?php echo $ip; ?></span></a></li> <?php } ?>
		  <?php if($oh > 0){ ?><li id="btnOh"><a href="#On Hold">On Hold <span class="badge pull-right"><?php echo $oh; ?></span></a></li><?php } ?>
		  <?php if($rfc > 0){ ?><li id="btnRfc"><a href="#Ready For Collection">Ready For Collection <span class="badge pull-right"><?php echo $rfc; ?></span></a></li><?php } ?>
		</ul>
		<div id="workOrderList">
			<div align="center">
				<img src="img/loading.gif">
			</div>
		</div>

<?php include("includes/footer.php"); ?>

<script>

$(document).ready(function() {

	var status,hash;	

	if ("<?php echo $rfc; ?>" > 0){status = "Ready For Collection";}
	if ("<?php echo $oh; ?>" > 0){status = "On Hold";}
	if ("<?php echo $ip; ?>" > 0){status = "In Progress";}
	if ("<?php echo $tbi; ?>" > 0){status = "To Be Inspected";}

	checkHash();	
	loadWorkOrders(status);

 	$("#btnTbi").click(function() {
   		var status = "To Be Inspected";
   		$('[id^="btn"]').removeClass("active");
   		$(this).addClass("active");
   		loadWorkOrders(status);
 	});
	$("#btnIp").click(function() {
   		var status = "In Progress";
   		$('[id^="btn"]').removeClass("active");
   		$(this).addClass("active");
   		loadWorkOrders(status);
 	});
 	$("#btnOh").click(function() {
   		var status = "On Hold";
   		$('[id^="btn"]').removeClass("active");
   		$(this).addClass("active");
   		loadWorkOrders(status);
 	});    
 	$("#btnRfc").click(function() {
   		var status = "Ready For Collection";
   		$('[id^="btn"]').removeClass("active");
   		$(this).addClass("active");
   		loadWorkOrders(status);
 	});

 	window.onpopstate = function(event)
	{
	    $('[id^="btn"]').removeClass("active");
	    checkHash();
	    loadWorkOrders(hash);
	};

 	function checkHash(){
		hash = window.location.hash.substring(1);
		if (hash == "To Be Inspected"){$("#btnTbi").addClass("active");}
		if (hash == "In Progress"){$("#btnIp").addClass("active");}
		if (hash == "On Hold"){$("#btnOh").addClass("active");}
		if (hash == "Ready For Collection"){$("#btnRfc").addClass("active");}	

		if (hash == ''){
			window.location.hash = status;
			$('[id^="btn"]').removeClass("active");
	        checkHash();
		}		
	}			

 	function loadWorkOrders(status){
    	$.ajax({
	    	url: "work_orders_ajax.php?q="+status+"",      
		}).success(function(response) {
			$("#workOrderList").html(response); 		
		});
    }
})

</script>