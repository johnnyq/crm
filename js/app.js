<script>

	$( '[id^="btnInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		collapseInsideWorkOrder(id);
	});

	$( '[id^="btnCancelInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		cancelInsideWorkOrder(id);
	});

	$( '[id^="submitInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		processInsideWorkOrder(id);
	});

	function collapseInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).removeClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).hide();
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).addClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
		
	}

	function processInsideWorkOrder(id){	
		var customer = $( "#customer_"+id ).val();
		var type = $( "#type_"+id ).val();
		var make = $( "#make_"+id ).val();
		var model = $( "#model_"+id ).val();
		var serial = $( "#serial_"+id ).val();
		var scope = $( "#scope_"+id ).val();
		var takeInNotes = $( "#takein_notes_"+id ).val();
		$.ajax({
	    	url: "post.php?new_inside_work_order="+id+"&scope="+scope+"&takein_notes="+takeInNotes+"&type="+type+"&make="+make+"&model="+model+"&serial="+serial+"&customer_id="+customer+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelInsideWorkOrder(id);
			loadOpenWorkOrders();
			loadWorkOrderHistory();
		});
	}

	function loadOpenWorkOrders(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_open_work_orders.php?id="+customerId+"",      
		}).success(function(response) {
			$("#openWorkOrders").html(response); 		
		});
	}

	function loadWorkOrderHistory(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_work_order_history.php?id="+customerId+"",      
		}).success(function(response) {
			$("#workOrderHistory").html(response); 		
		});
	}


	$( '[id^="btnExtendWarranty_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		collapseExtendWarranty(id);
	});

	$( '[id^="btnCancelExtendWarranty_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		cancelExtendWarranty(id);
	});

	$( '[id^="submitExtendWarranty_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		processExtendWarranty(id);
	});

	$( '[id^="btnReturn_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		collapseReturn(id);
	});

	$( '[id^="btnCancelReturn_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		cancelReturn(id);
	});

	$( '[id^="submitReturn_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		processReturn(id);
	});

	$( '[id^="btnInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		collapseInsideWorkOrder(id);
	});

	$( '[id^="btnCancelInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		cancelInsideWorkOrder(id);
	});

	$( '[id^="submitInsideWorkOrder_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		processInsideWorkOrder(id);
	});


	function collapseExtendWarranty(id){	
		$( "#collapseExtendWarranty_"+id ).removeClass("hide");
		$( "#collapseExtendWarranty_"+id ).hide();
		$( "#collapseExtendWarranty_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelExtendWarranty(id){	
		$( "#collapseExtendWarranty_"+id ).addClass("hide");
		$( "#collapseExtendWarranty_"+id ).fadeIn( "slow", function() {});
		
	}

	function processExtendWarranty(id){	
		var warranty = $( "#warranty_"+id ).val();
		$.ajax({
	    	url: "post.php?extend_warranty="+id+"&warranty="+warranty+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelExtendWarranty(id);
			loadReturnsHistory();
			loadSalesHistory();
		});
	}

	function collapseReturn(id){	
		$( "#collapseReturn_"+id ).removeClass("hide");
		$( "#collapseReturn_"+id ).hide();
		$( "#collapseReturn_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelReturn(id){	
		$( "#collapseReturn_"+id ).addClass("hide");
		$( "#collapseReturn_"+id ).fadeIn( "slow", function() {});
		
	}

	function processReturn(id){	
		var reason = $( "#reason_"+id ).val();
		$.ajax({
	    	url: "post.php?computer_return="+id+"&reason="+reason+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelReturn(id);
			loadReturnsHistory();
			loadSalesHistory();
		});
	}

	function collapseInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).removeClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).hide();
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelInsideWorkOrder(id){	
		$( "#collapseInsideWorkOrder_"+id ).addClass("hide");
		$( "#collapseInsideWorkOrder_"+id ).fadeIn( "slow", function() {});
		
	}

	function processInsideWorkOrder(id){	
		var customer = $( "#customer_"+id ).val();
		var type = $( "#type_"+id ).val();
		var make = $( "#make_"+id ).val();
		var model = $( "#model_"+id ).val();
		var serial = $( "#serial_"+id ).val();
		var scope = $( "#scope_"+id ).val();
		var takeInNotes = $( "#takein_notes_"+id ).val();
		$.ajax({
	    	url: "post.php?new_inside_work_order="+id+"&scope="+scope+"&takein_notes="+takeInNotes+"&type="+type+"&make="+make+"&model="+model+"&serial="+serial+"&customer_id="+customer+"",       
		}).success(function(response) {
	  		$("#response").html(response);
	  		cancelInsideWorkOrder(id);
			loadOpenWorkOrders();
			loadWorkOrderHistory();
		});
	}

	function loadReturnsHistory(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_returns.php?id="+customerId+"",      
		}).success(function(response) {
			$("#returnsHistory").html(response); 		
		});
	}

	function loadSalesHistory(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_sales.php?id="+customerId+"",      
		}).success(function(response) {
			$("#salesHistory").html(response); 		
		});
	}

	function loadOpenWorkOrders(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_open_work_orders.php?id="+customerId+"",      
		}).success(function(response) {
			$("#openWorkOrders").html(response); 		
		});
	}

	function loadWorkOrderHistory(){
		var customerId = "<?php echo $id; ?>";
		$.ajax({
	    	url: "customer_details_work_order_history.php?id="+customerId+"",      
		}).success(function(response) {
			$("#workOrderHistory").html(response); 		
		});
	}

	$( '[id^="delete_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		deleteNote(id);
	});

	$( '[id^="edit_"]' ).click(function() {
		var id = this.id;
		id = id.split("_");
		id = id[1];
		editNote(id);
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
		processEditNote(id);
	});

	function deleteNote(id){	
		$.ajax({
	    	url: "post.php?delete_customer_note="+id+"",       
		}).success(function(response) {
	  		$( "#note_"+id ).slideUp( "slow", function() {
			});
		});
	}

	function editNote(id){	
		$( "#noteCol2_"+id ).addClass("hide");
		$( "#noteEditCol2_"+id ).removeClass("hide");
		$( "#noteEditCol2_"+id ).hide();
		$( "#noteEditCol2_"+id ).fadeIn( "slow", function() {});
		
	}

	function cancelEdit(id){
		$( "#noteEditCol2_"+id ).addClass("hide");
		$( "#noteCol2_"+id ).removeClass("hide");
		$( "#noteCol2_"+id ).hide();
		$( "#noteCol2_"+id ).fadeIn( "slow", function() {});
		
	}

	function processEditNote(id){	
		var note = $( "#txtNote_"+id ).val();
		$.ajax({
	    	url: "post.php?edit_customer_note="+id+"&note="+note+"",       
		}).success(function(response) {
	  		cancelEdit(id);
	  		$( "#noteHolder_"+id ).html($( "#txtNote_"+id ).val());
		});
	}

	function loadSalesHistory(){
    	var customerId = "<?php echo $id; ?>";
    	$.ajax({
	    	url: "customer_details_sales.php?id="+customerId+"",      
		}).success(function(response) {
			$("#salesHistory").html(response); 		
		});
    }

    function loadReturnsHistory(){
    	var customerId = "<?php echo $id; ?>";
    	$.ajax({
	    	url: "customer_details_returns.php?id="+customerId+"",      
		}).success(function(response) {
			$("#returnsHistory").html(response); 		
		});
    }

    function loadOpenWorkOrders(){
    	var customerId = "<?php echo $id; ?>";
    	$.ajax({
	    	url: "customer_details_open_work_orders.php?id="+customerId+"",      
		}).success(function(response) {
			$("#openWorkOrders").html(response); 		
		});
    }

    function loadWorkOrderHistory(){
    	var customerId = "<?php echo $id; ?>";
    	$.ajax({
	    	url: "customer_details_work_order_history.php?id="+customerId+"",      
		}).success(function(response) {
			$("#workOrderHistory").html(response); 		
		});
    }

    function loadNotes(){
    	var customerId = "<?php echo $id; ?>";
    	$.ajax({
	    	url: "customer_details_notes.php?id="+customerId+"",      
		}).success(function(response) {
			$("#notesHistory").html(response); 		
		});
    }


	$("#formSale").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	        	loadSalesHistory();
	        	$('#collapseSale').collapse('toggle');
	        	$("#formSale")[0].reset();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	$("#formWorkOrder").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            loadWorkOrderHistory();
	            loadOpenWorkOrders();
	            $('#collapseWorkOrder').collapse('toggle');
	        	$("#formWorkOrder")[0].reset();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

	$("#formNote").submit(function(e)
	{
		var postData = $(this).serializeArray();	   
	    $.ajax(
	    {
	        url : "post.php",
	        type: "POST",
	        data : postData,
	        success : function(response)
	        {
	            $("#response").html(response);
	            loadNotes();
	            $('#collapseNote').collapse('toggle');
	        	$("#formNote")[0].reset();
	        }, 	
	    });
	    e.preventDefault(); //STOP default POST action
	});

</script>