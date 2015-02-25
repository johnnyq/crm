<?php

	header("Content-Type:text/plain");

	include "config.php";
	include "includes/check_login.php";
    if(isset($_GET['q'])){
         if (isset($_GET['p'])){
		    $p = intval($_GET['p']);
		    if ($p < 1){
		    	$p = 1;
		    }
		    $record_from = (($p)-1)*10;
		    $record_to =  10;
		}else{
			$record_from = 0;
			$record_to = 10;
			$p = 1;
		}
        $q = $_GET['q'];

        $sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM computers
			WHERE system_number LIKE '%$q%'
			OR type LIKE '%$q%' 
			OR make LIKE '%$q%'
			OR model LIKE '%$q%'
			OR CONCAT(make,' ',type) LIKE '%$q%'
			OR CONCAT(make,' ',model) LIKE '%$q%'
			OR serial LIKE '%$q%'
			OR os LIKE '%$q%'
			OR CONCAT(os,' ',type) LIKE '%$q%'
			OR processor LIKE '%$q%'
			OR status LIKE '%$q%'
			ORDER BY computer_id DESC LIMIT $record_from, $record_to"
    	);

	    $num = mysql_num_rows($sql);
	    $num_rows = mysql_fetch_row(mysql_query("SELECT FOUND_ROWS()"));
		$total_found_rows = $num_rows[0];
	    $total_pages = ceil($total_found_rows / 10);
		    
		if ($p > $total_pages){
			$p = $total_pages;  
		    $record_from = (($p)-1)*10;
		    $record_to =  10;

			$sql = mysql_query("SELECT SQL_CALC_FOUND_ROWS * FROM computers
				WHERE system_number LIKE '%$q%'
				OR type LIKE '%$q%' 
				OR make LIKE '%$q%'
				OR model LIKE '%$q%'
				OR CONCAT(make,' ',type) LIKE '%$q%'
				OR CONCAT(make,' ',model) LIKE '%$q%'
				OR serial LIKE '%$q%'
				OR os LIKE '%$q%'
				OR CONCAT(os,' ',type) LIKE '%$q%'
				OR processor LIKE '%$q%'
				OR status LIKE '%$q%'
				ORDER BY computer_id DESC LIMIT $record_from, $record_to"
	    	);

		    $num = mysql_num_rows($sql);
		    $total_pages = ceil($total_found_rows / 10);
		} 		
		
		if($num > 0){ 

?>

<table class="table table-hover">	
    <thead>	
        <tr>	
            <th>System</th>
			<th>Computer</th>
			<th>Specs</th>
			<th>Status</th>
			<th>Price</th>
			<th>Added</th>
			<th></th>
		</tr>
	</thead>
    <tbody>
		
        <?php

			while($row = mysql_fetch_array($sql)){
				$id = $row['computer_id'];
                $system_number = $row['system_number'];
                $type = ucwords($row['type']);
                if($type == 'Laptop'){
                	$type = 'fa fa-laptop';
                }elseif($type == 'Desktop'){
                	$type = 'fa fa-desktop';
                }
                $make = ucwords($row['make']);
                $model = ucwords($row['model']);
                $serial = $row['serial'];
                $os = $row['os'];
                $processor = $row['processor'];
                $hard_drive = $row['hard_drive'];
                $memory = $row['memory'];
                $price = $row['price'];
                $status = $row['status'];
                $human_time = human_time($row['date_added']);
                $date_added = date($date_format,$row['date_added']);
                
                if($status == 'sold'){
                	$sql2 = mysql_query("SELECT * FROM computer_sales, customers WHERE computer_sales.customer_id = customers.customer_id AND computer_sales.computer_id = $id ");
                	$row2 = mysql_fetch_array($sql2);
                	$customer_id = $row2['customer_id'];
                	$last_name = ucwords($row2['last_name']);
    				$first_name = ucwords($row2['first_name']);
                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a></small>";
                }elseif($status == 'returned'){
                	$sql2 = mysql_query("SELECT * FROM computer_returns, customers WHERE computer_returns.customer_id = customers.customer_id AND computer_id = $id");
                	$row2 = mysql_fetch_array($sql2);
                	$customer_id = $row2['customer_id'];
                	$last_name = ucwords($row2['last_name']);
    				$first_name = ucwords($row2['first_name']);
                	$display = "<br><small><a href='customer_details.php?id=$customer_id'><i class='glyphicon glyphicon-link'></i> $first_name $last_name</a></small>";
                }else{
                	$display = "";
                }

                echo "
					<tr id='tr_$id'>
						<td><i class='$type'></i> $system_number</td>
						<td>$make $model<br><small>$serial</small></td>
						<td>$processor<br><small>$memory MB / $hard_drive GB</small></td>
						<td>$status $display</td>
						<td>$$price</td>
						<td>$human_time</td>
						<td>
							<div class='btn-group'>
							    <a class='btn btn-default' id='printComputerLabel_$id'><span class='glyphicon glyphicon-barcode'></span></a>
							    <a class='btn btn-default' href='edit_computer.php?id=$id'><span class='glyphicon glyphicon-pencil'></span></a>
                            </div>
						</td>
					</tr>
				";
			}
		?>
	
    </tbody>
</table>
			
<small class="text-muted pull-right">Records: <?php echo $total_found_rows; ?></small>

<?php 
	
	if ($total_found_rows > 10) { 

?>

<ul class="pagination">			

<?php

	if ($total_pages <= 100 ){$pages_split = 10;}
	if (($total_pages <= 1000) AND ($total_pages > 100)){$pages_split = 100;}
	if (($total_pages <= 10000) AND ($total_pages > 1000)){$pages_split = 1000;}

    $url_query_strings = http_build_query(array_merge($_GET,array('p' => $i)));
    $prev_page = $p - 1;
    $next_page  = $p + 1;
    if ($p > 1 ){echo "<li id='p_$prev_page' class='prev'><a href='#$url_query_strings&p=$prev_page'>Prev</a></li>";}
	
	while ($i < $total_pages){
    	$i++;
		if (($i == 1) OR (($p <= 3 ) AND ($i <= 6)) OR (( $i >  $total_pages - 6) AND ($p > $total_pages - 3 )) OR (is_int($i / $pages_split)) OR (($p > 3 ) AND ($i >= $p - 2) AND ($i <= $p + 3)) OR ($i == $total_pages)){
	        if ($p == $i ) {
	        	$page_class = "active"; 
	        }else{ 
	        	$page_class = "";
	    	}
	    	echo "<li id='p_$i' class='$page_class'><a href='#$url_query_strings&p=$i'>$i</a></li>";
		}
	}
	if ($p <> $total_pages ) {echo "<li id='p_$next_page' class='next'><a href='#$url_query_strings&p=$next_page'>Next</a></li>";}

?>

</ul>

<?php 
   
    } //  if (total_found_rows >= 10)   
   	}else{ //if no records found
		echo "<div class='alert alert-danger'>No records found.</div>";
	}
}//if(isset($_GET['q'])){
	// echo "<script src='js/DYMO.Label.Framework.js'></script>";
	// echo "<script src='js/PreviewAndPrintLabel.js'></script>";
?>

<div class="modal fade" id="computerLabelModel" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Print Computer Label</h4>
      </div>
      <div class="modal-body">
      	<div id="computerLabelContent">
			<div align="center">
				<img id='labelImage' alt='label preview'>
			</div>
			<br>
			<div class="input-group">
			  <select class="form-control input-lg" id='printersSelect'></select>
			  <span class="input-group-btn">
			    <button class="btn btn-default btn-primary btn-lg" type="button" id='printButton'><i class="glyphicon glyphicon-print"></i></button>
			  </span>
			</div><!-- /input-group -->	
      	</div>
      </div>
      
    </div>
  </div>
</div>  

<script src='js/DYMO.Label.Framework.js'></script>
<script src='js/PreviewAndPrintLabel.js'></script>

<script>

$(document).ready(function() {
	$( '[id^="printComputerLabel_"]' ).click(function() {
		var computerID = this.id;
	 	computerID = computerID.split("_");
	 	computerID = computerID[1];
		previewAndPrint('computer',computerID);
		$('#computerLabelModel').modal("show");
	});
})

</script>