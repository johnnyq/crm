<?php

	include "config.php";
	include "includes/check_login.php";

	$time_now = time();

	if(isset($_POST['add_customer'])){

      $company = mysql_real_escape_string(ucwords(strtolower($_POST['company'])));
      $first_name = mysql_real_escape_string(ucwords(strtolower($_POST['first_name'])));
      $last_name = mysql_real_escape_string(ucwords(strtolower($_POST["last_name"])));
      $address = mysql_real_escape_string(ucwords(strtolower($_POST["address"])));
      $city = mysql_real_escape_string(ucwords(strtolower($_POST["city"])));
      $state = mysql_real_escape_string(strtoupper($_POST["state"]));
      $zip = mysql_real_escape_string($_POST['zip']);
      $phone = mysql_real_escape_string(preg_replace("/[^0-9]/", '',$_POST["phone"]));
      $mobile = mysql_real_escape_string(preg_replace("/[^0-9]/", '',$_POST["mobile"]));
      $email = mysql_real_escape_string(strtolower($_POST["email"]));

      $sql = mysql_query("INSERT INTO customers SET company = '$company', first_name = '$first_name', last_name = '$last_name', address = '$address', city = '$city', state = '$state', zip = '$zip', phone = '$phone', mobile = '$mobile', email = '$email', date_added = $time_now");

      echo "<div class='alert alert-info'>Customer <strong>$first_name $last_name</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['edit_customer'])){

      $id = mysql_real_escape_string($_POST['id']);
      $company = mysql_real_escape_string(ucwords(strtolower($_POST['company'])));
      $first_name = mysql_real_escape_string(ucwords(strtolower($_POST['first_name'])));
      $last_name = mysql_real_escape_string(ucwords(strtolower($_POST["last_name"])));
      $address = mysql_real_escape_string(ucwords(strtolower($_POST["address"])));
      $city = mysql_real_escape_string(ucwords(strtolower($_POST["city"])));
      $state = mysql_real_escape_string(strtoupper($_POST["state"]));
      $zip = mysql_real_escape_string($_POST['zip']);
      $phone = mysql_real_escape_string(preg_replace("/[^0-9]/", '',$_POST["phone"]));
      $mobile = mysql_real_escape_string(preg_replace("/[^0-9]/", '',$_POST["mobile"]));
      $email = mysql_real_escape_string(strtolower($_POST["email"]));

      $sql = mysql_query("UPDATE customers SET company = '$company', first_name = '$first_name', last_name = '$last_name', address = '$address', city = '$city', state = '$state', zip = '$zip', phone = '$phone', mobile = '$mobile', email = '$email' WHERE customer_id = $id");

      echo "<div class='alert alert-info'>User <strong>$first_name $last_name</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['add_user'])){

    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);
      $email = mysql_real_escape_string($_POST['email']);
      $first_name = mysql_real_escape_string($_POST['first_name']);
      $last_name = mysql_real_escape_string($_POST['last_name']);
      $security_level = mysql_real_escape_string($_POST['security_level']);
      $location = mysql_real_escape_string($_POST['location']);

      $sql = mysql_query("INSERT INTO users SET username = '$username', password = '$password', user_first_name = '$first_name', user_last_name = '$last_name', user_email = '$email', user_date_added = $time_now, security_level = $security_level, avatar = 'img/avatars/anon.png', location = $location, start_page = 'dashboard.php'");

      echo "<div class='alert alert-info'>User <strong>$username</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

	if(isset($_POST['edit_user'])){

    	$id = $_POST['id'];
    	$username = mysql_real_escape_string($_POST['username']);
    	$password = mysql_real_escape_string($_POST['password']);
      $email = mysql_real_escape_string($_POST['email']);
      $first_name = mysql_real_escape_string($_POST['first_name']);
      $last_name = mysql_real_escape_string($_POST['last_name']);
      $security_level = mysql_real_escape_string($_POST['security_level']);
      $location = mysql_real_escape_string($_POST['location']);
      $avatar = mysql_real_escape_string($_POST['avatar']);
      $sql = mysql_query("UPDATE users SET username = '$username', password = '$password', user_email = '$email', user_first_name = '$first_name', user_last_name = '$last_name', security_level = $security_level, location = $location, avatar = '$avatar' WHERE user_id = $id");

      echo "<div class='alert alert-info'>User <strong>$username</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['change_user_preferences'])){

      $id = $_POST['id'];
      $username = mysql_real_escape_string($_POST['username']);
      $email = mysql_real_escape_string($_POST['email']);
      $password = mysql_real_escape_string($_POST['password']);
      $avatar = mysql_real_escape_string($_POST['avatar']);
      $start_page = mysql_real_escape_string($_POST['start_page']);

      $sql = mysql_query("UPDATE users SET username = '$username', user_email = '$email', password = '$password', avatar = '$avatar', start_page = '$start_page' WHERE user_id = $id");

      echo "<div class='alert alert-info'>User preferences updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['add_location'])){

      $location = mysql_real_escape_string($_POST['location']);

      $sql = mysql_query("INSERT INTO locations SET location = '$location', active = 1");

      echo "<div class='alert alert-info'>Location <strong>$location</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['edit_location'])){

      $id = $_POST['id'];
      $location = mysql_real_escape_string($_POST['location']);

      $sql = mysql_query("UPDATE locations SET location = '$location' WHERE location_id = $id");

      echo "<div class='alert alert-info'>Location <strong>$location</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_GET['delete_location'])){
        $id = $_GET['delete_location'];

        $sql = mysql_query("UPDATE locations SET active = 0 WHERE location_id = $id");

        echo "<div class='alert alert-warning'>Location removed.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['add_computer'])){

      $system_number = mysql_real_escape_string($_POST['system_number']);
      $type = mysql_real_escape_string($_POST['type']);
      $make = mysql_real_escape_string($_POST['make']);
      $model = ucwords(mysql_real_escape_string($_POST['model']));
      $serial = strtoupper(mysql_real_escape_string($_POST['serial']));
      $os = mysql_real_escape_string($_POST['os']);
      $coa = mysql_real_escape_string($_POST['coa']);
      $processor = mysql_real_escape_string($_POST['processor']);
      $memory = $_POST['memory'];
      $hard_drive = $_POST['hard_drive'];
      $price = $_POST['price'];

      $sql = mysql_query("SELECT serial FROM computers WHERE serial = '$serial'");
      $num_rows = mysql_num_rows($sql);
      if($num_rows == 0){
      mysql_query("INSERT INTO computers SET system_number = '$system_number', type = '$type', make = '$make', model = '$model', serial = '$serial', os = '$os', coa = '$coa', processor = '$processor', memory = $memory, hard_drive = $hard_drive, price = $price, status = 'stock', date_added = $time_now");
	    echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";	
      $computer_id = mysql_insert_id();
      echo "|$computer_id";
      }else{
	    echo "<div class='alert alert-danger'>Computer <strong>$make $model</strong> with same serial number of <strong>$serial</strong> and System Number $system_number already exists.<button class='close' data-dismiss='alert'>&times;</button></div>";
  	  }
  }

  if(isset($_POST['edit_computer'])){

      $id = $_POST['id'];
      $system_number = mysql_real_escape_string($_POST['system_number']);
      $type = mysql_real_escape_string($_POST['type']);
      $make = mysql_real_escape_string($_POST['make']);
      $model = ucwords(mysql_real_escape_string($_POST['model']));
      $serial = strtoupper(mysql_real_escape_string($_POST['serial']));
      $os = mysql_real_escape_string($_POST['os']);
      $coa = mysql_real_escape_string($_POST['coa']);
      $processor = mysql_real_escape_string($_POST['processor']);
      $memory = $_POST['memory'];
      $hard_drive = $_POST['hard_drive'];
      $price = $_POST['price'];
      $status = mysql_real_escape_string($_POST['status']);
      
      mysql_query("UPDATE computers SET system_number = '$system_number', make = '$make', model = '$model', serial = '$serial', coa = '$coa', os = '$os', processor = '$processor', memory = $memory, hard_drive = $hard_drive, price = $price, status = '$status' WHERE computer_id = $id");

      echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_GET['delete_computer'])){
        $id = $_GET['delete_computer'];

        $sql = mysql_query("UPDATE inventory SET active = 0 WHERE inventory_id = $id");

        echo "<div class='alert alert-warning'>Computer removed.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }
  
  if(isset($_GET['delete_work_order_note'])){
        $id = $_GET['delete_work_order_note'];
        
        $sql = mysql_query("UPDATE work_order_notes SET active = 0, date_modified = $time_now, modified_by = $session_user_id WHERE work_order_note_id = $id");

        echo "<div class='alert alert-warning'>Note Deleted.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_GET['delete_customer_note'])){
        $id = $_GET['delete_customer_note'];
        $sql = mysql_query("UPDATE customer_notes SET active = 0, date_modified = $time_now, modified_by = $session_user_id WHERE customer_note_id = $id");

        echo "<div class='alert alert-warning'>Note Deleted.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['add_make'])){

      $make = mysql_real_escape_string($_POST['make']);

      $sql = mysql_query("INSERT INTO makes SET make = '$make', active = 1");

      echo "<div class='alert alert-info'>Make <strong>$make</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
  }

  if(isset($_POST['transfer_location'])){

      $location_id = mysql_real_escape_string($_POST['location']);
      $serial = mysql_real_escape_string($_POST['serial']);

      $sql = mysql_query("SELECT * FROM inventory WHERE serial = '$serial'");
      $row = mysql_fetch_array($sql);
      $inventory_id = $row['inventory_id'];

      $num_rows = mysql_num_rows($sql);
      if($num_rows == 0){ 
        echo "<div class='alert alert-danger'>Computer with serial <strong>$serial</strong> does not exist. <button class='close' data-dismiss='alert'>&times;</button></div>"; 
      }else{
        $sql = mysql_query("INSERT INTO tracking SET tracking_date = $time_now, inventory_id = $inventory_id, location_id = $location_id, user_id = $session_user_id");
        $sql = mysql_query("UPDATE inventory SET location_id = $location_id WHERE inventory_id = $inventory_id");
        echo "<div class='alert alert-success'>Computer with serial <strong>$serial</strong> transferred. <button class='close' data-dismiss='alert'>&times;</button></div>";
      }
  }

  //ADD SALE POST CODE
if (isset($_POST['new_sale'])){ 
    $customer_id = $_POST['customer_id'];
    $system_number = strtoupper($_POST['system_number']);
    $warranty = $_POST['warranty'];
    $date_of_sale = strtotime($_POST['date_of_sale']);
    
    if($date_of_sale == ''){
     	$date_of_sale = time();
    }
    
    $sql = mysql_query("SELECT * FROM computers WHERE system_number = '$system_number'");
    $row = mysql_fetch_array($sql); 
      
    $computer_id = $row['computer_id'];
    $status = $row['status'];
      
    if ($status == ''){  
      
      echo "<div class='alert alert-warning'><p><strong>Computer $system_number</strong> Does not Exist!</p></div>";
    
    }else if ($status == 'sold'){
 
        $sql = mysql_query("SELECT * FROM computers, users, computer_sales, customers 
	        WHERE computer_sales.customer_id = customers.customer_id
	        AND computers.computer_id = '$computer_id' 
	        AND computer_sales.computer_id = '$computer_id' 
	        AND users.user_id = computer_sales.employee_id"
        );

        $row = mysql_fetch_array($sql);
        $customer_num = $row['customer_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $username = ucwords($row['username']);
        $sale_date = $row['sale_date'];
        $sale_date = date('F d, g:i a', $row['sale_date']);
            
        echo "
	        <div class='alert alert-warning'>
	        	<p><strong>Computer $system_number</strong> Has been sold to <a href='customer_details.php?id=$customer_num'>$first_name $last_name</a> $sale_date_rel on $sale_date by $username</p>
	        </div>
        ";  
        
    }else{
    
	   	mysql_query("INSERT INTO computer_sales SET sale_date = $date_of_sale, warranty = $warranty, computer_id = $computer_id, employee_id = $session_user_id, customer_id = $customer_id");

	    $sale_id = mysql_insert_id();

	    mysql_query("UPDATE computers SET status = 'sold' WHERE computer_id = $computer_id");
	      
	    echo "
	        <div class='alert alert-info'>
	        	<p><strong>Computer $system_number</strong> Sale Completed! <a href='print_sales_agreement.php?id=$sale_id' target='_blank'>PRINT SALES AGREEMENT</a></p>
	        </div>
	    ";
    }
}

//COMPUTER RETURN POST CODE
if (isset($_GET['computer_return'])){

	$sale_id = $_GET['computer_return'];
    $reason = mysql_real_escape_string($_GET['reason']);

    $sql = mysql_query("SELECT * FROM computer_sales WHERE sale_id = $sale_id");

    $row = mysql_fetch_array($sql);
    $computer_id = $row['computer_id'];
    $sale_date = $row['sale_date'];
    $sales_person = $row['employee_id'];
    $customer_id = $row['customer_id'];
   
    mysql_query("INSERT INTO computer_returns SET reason = '$reason', return_date = $time_now, customer_id = $customer_id, computer_id = $computer_id, employee_id = $session_user_id, sale_date = $sale_date, sales_person = $sales_person");
    mysql_query("DELETE FROM computer_sales WHERE sale_id = $sale_id");
	  mysql_query("UPDATE computers SET status = 'returned' WHERE computer_id = $computer_id");
	
	echo "
    	<div class='alert alert-success'>
    		<p><strong>Computer Returned!</strong></p>
    	</div>
   	";
}

//EXTEND WARRANTY
if (isset($_GET['extend_warranty'])){

	$id = $_GET['extend_warranty'];
	$warranty = $_GET['warranty'];
   
	mysql_query("UPDATE computer_sales SET warranty = $warranty WHERE sale_id = $id");
	
	echo "
    	<div class='alert alert-info'>
    		<p><strong>Warranty has been extended!<br>please print a New Sales Agreement for the customer.</strong></p>
    	</div>
   	";
}

if(isset($_POST['new_customer_note'])){

    $customer_id = $_POST['customer_id'];
    $note = mysql_real_escape_string($_POST['note']);

    $sql = mysql_query("INSERT INTO customer_notes SET note = '$note', date_added = $time_now, employee = $session_user_id, customer = $customer_id, active = 1");

    echo "<div class='alert alert-info'>Note <strong>$note</strong> made.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_POST['new_work_order_note'])){

    $id = $_POST['work_order_id'];
    $note = mysql_real_escape_string($_POST['note']);

    $sql = mysql_query("INSERT INTO work_order_notes SET work_order_id = $id, employee = $session_user_id, date_added = $time_now, note = '$note', active = 1");
    
}

if(isset($_GET['edit_customer_note'])){

    $id = $_GET['edit_customer_note'];
    $note = mysql_real_escape_string($_GET['note']);

    $sql = mysql_query("UPDATE customer_notes SET note = '$note', date_modified = $time_now, modified_by = $session_user_id WHERE customer_note_id = $id");

    echo "<div class='alert alert-info'>Note <strong>$note</strong> updated.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['edit_work_order_note'])){

    $id = $_GET['edit_work_order_note'];
    $note = mysql_real_escape_string($_GET['note']);

    $sql = mysql_query("UPDATE work_order_notes SET note = '$note', date_modified = $time_now, modified_by = $session_user_id WHERE work_order_note_id = $id");

}

if(isset($_POST['new_work_order'])){
      $customer_id = $_POST['customer_id'];
      $scope = mysql_real_escape_string($_POST['scope']);
      $asset_type = mysql_real_escape_string($_POST['asset_type']);
      $make = mysql_real_escape_string($_POST['make']);
      $model = ucwords(mysql_real_escape_string($_POST['model']));
      $serial = strtoupper(mysql_real_escape_string($_POST['serial']));
      $takein_notes = mysql_real_escape_string($_POST['takein_notes']);

      mysql_query("INSERT INTO work_orders SET work_order_type = '$scope', type = '$asset_type', make = '$make', model = '$model', serial = '$serial', work_order_status = 'To Be Inspected', description = '$takein_notes', take_in_date = $time_now, take_in_employee = $session_user_id, customer_id = $customer_id");
      echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}

if(isset($_GET['new_inside_work_order'])){
      $customer_id = $_GET['customer_id'];
      $scope = mysql_real_escape_string($_GET['scope']);
      $type = mysql_real_escape_string($_GET['type']);
      $make = mysql_real_escape_string($_GET['make']);
      $model = ucwords(mysql_real_escape_string($_GET['model']));
      $serial = strtoupper(mysql_real_escape_string($_GET['serial']));
      $takein_notes = mysql_real_escape_string($_GET['takein_notes']);

      mysql_query("INSERT INTO work_orders SET work_order_type = '$scope', type = '$type', make = '$make', model = '$model', serial = '$serial', work_order_status = 'To Be Inspected', description = '$takein_notes', take_in_date = $time_now, take_in_employee = $session_user_id, customer_id = $customer_id");
      echo "<div class='alert alert-info'>Computer <strong>$make $model</strong> with serial <strong>$serial</strong> added.<button class='close' data-dismiss='alert'>&times;</button></div>";
}



if(isset($_GET['update_work_order_status'])){

      $id = $_GET['id'];
      $status = mysql_real_escape_string($_GET['status']);
      
      mysql_query("UPDATE work_orders SET work_order_status = '$status' WHERE work_order_id = $id");
      mysql_query("INSERT INTO work_order_notes SET work_order_id = $id, employee = $session_user_id, date_added = $time_now, note = '$status', active = 1");
      echo "<div class='alert alert-info'>Work Order Status has been updated. <button class='close' data-dismiss='alert'>&times;</button></div>";
  }

if(isset($_POST['send_message'])){

      $message = mysql_real_escape_string($_POST['message']);
      $message_to = $_POST['message_to'];

      $sql = mysql_query("INSERT INTO messages SET message = '$message', message_to = $message_to, message_from = $session_user_id, sent_timestamp = $time_now, message_active = 1");

      echo "<div class='alert alert-info'>Message <strong>Sent</strong>!<button class='close' data-dismiss='alert'>&times;</button></div>";
}

?>