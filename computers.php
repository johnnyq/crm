<?php

	include "config.php";
	include "includes/header.php"; 
	include "includes/check_login.php";
	include "includes/nav.php";

?>

<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
					<input type="text" class="form-control" name="q" id="q" placeholder="Search Computer Inventory" autocomplete="off" autofocus>
					<span class="input-group-btn">
						<button class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
			<div class="col-md-8">
				<a class="btn btn-primary pull-right" href='add_computer.php'><span class="glyphicon glyphicon-plus"></span> Add Computer</a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div id="table"></div>
	</div>
</div>

<?php include "includes/footer.php"; ?>

<script>
  
$(document).ready(function() {
  	checkHash();
	function checkHash(){
			var hash = window.location.hash.substring(1);
			if (hash != ''){
				query(hash);
			}else{
				query('q=');
			}
	}			
		
	$(window).on('hashchange', function() {
		q = window.location.hash.substring(1);
		var qval = urlGetVars("q");
		$("#q").val(qval);
	  	query(q)
	});

	$("#q").keyup(function(){
		var q = $("#q").val();
		q = "q="+q+"";
		window.location.hash = q;
		query(q);	
	});
	
	function query(q){		
		$.ajax({
		    url: "computers_ajax.php?"+q+"",      
		}).success(function(response) {
		    $("#table").html(response);
		    ajaxresponse();
		});
	}

	function deleteId(id){	
		id = id.split("_");
	 	id = id[1];		
		$.ajax({
	    	url: "post.php?delete_computer="+id+"",       
		}).success(function(response) {
	 		$('#tr_'+id).addClass("danger");
	  		$( "#tr_"+id ).fadeOut( "slow", function() {
	  			urlVars = urlGetVars();
			 	window.location.hash = urlVars;
			 	checkHash();	
			});
		});
	}

	function ajaxresponse(){
		$( '[id^="p_"]' ).click(function() {
			var pid = this.id;
		 	pid = pid.split("_");
		 	pid = pid[1];
			var q = $("#q").val();
			q = "q="+q+"&p="+pid;
			window.location.hash = q;
			query(q);
		}); 

		$( '[id^="del_"]' ).click(function() {
			var id = this.id;
			id = "delete="+id+"";
			deleteId(id);
		}); 	
	}

	function urlGetVars(varName){
		var hash = window.location.hash.substring(1);
		if(varName == undefined) {
			return hash;
		}
		hashes = hash.split("&");
		var len = hashes.length;
		var vars = [];
		for (var i = 0; i < len; i++){
			hashVar = hashes[i].split("=");
			if (hashVar[0] == varName){
				return hashVar[1];
			}      	
		}	
	}
});

</script> 