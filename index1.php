<html>
<head>
<meta http-equiv="Access-Control-Allow-Origin" content="*"/>
</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php 

   
	// echo $branch;
	 $GLOBALS['var'] = "";
	
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if (!empty($_REQUEST['locatorStr'])) {
			//echo "dd:". $_REQUEST['locatorStr'];exit;
			$locatorStr = $_REQUEST['locatorStr'];
			$json = json_decode($locatorStr, true);
			//print_r($locatorStr);
			echo "<pre>";
			$branch = $_REQUEST['branch_hidden'];
			$data = "";
			//$locatorStrs = explode(",",$locatorStr);
			$file = fopen("hdfcap.csv","a");
			foreach ($json['list'] as $list) {
				# code...
				$data = $list['lat'] .",".$list['lon'] .",".$list['address'].","."Andhra Pradesh";
				fwrite($file,$data."\n");
				print_r($data);
				echo"<hr>";
			}
			//print_r($json['list']);
			echo $branch;
			echo $branch." Data Created";
		?>
		
		<script>
		window.top.close();
		</script>
		<?php
		}
		
	}
	else
		{
			$GLOBALS['var'] = $_GET['branch'];
			$branch = $_GET['branch'];
			$LatLongString = $_GET['LatLongString'];
		    $Radius = $_GET['Radius'];
		    echo $GLOBALS['var'];
			
			
			
		}
?>

	<script>
	$(document).ready(function(){
		
		//var branch = "<?php echo $branch; ?>";
	$.ajax({
	   type: "POST",
	   url: "http://app.mapmyindia.com/hdfcweb/mmiFacade.do",
	   data: {
	   	where:"<?php echo $branch; ?>",
	     radius:"10",
	     stype:"atm",
	     act:"nearby",
	     bound:"null",
	     loc_x:"na",
	     loc_y:"na",
	     poi_id:"null"
		 },
		success: function(data){
			if(data.length<=0)
			{
				
				window.top.close();
			}
		// var json = JSON.parse(data);
		// var d = json.list[0].address + json.list[0].lat + json.list[0].lon + json.list[0].landmark;
		//alert(data);
		 $("#locatorStr").val(data);
			//    alert($("#locatorStr").val());
					$("#frm").submit();
					
	   }
	})
	 //var data = "test";
				   
	});
	</script>


<body>
<form name="frm" id="frm" method="post" action="index1.php">
<input type="hidden" name="locatorStr" id="locatorStr" value="">
<input type="hidden" name="branch_hidden" id="branch_hidden" value="<?php echo $branch; ?>">

</form>
</body>