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
			$branch = $_REQUEST['branch_hidden'];
			$locatorStrs = explode("$",$locatorStr);
			//print_r ($GLOBALS['var']);
			$file = fopen($branch.".csv","w");
			
			
		}
		exit;
		
	}
	else
		{
			$GLOBALS['var'] = $_GET['branch'];
			$branch = $_GET['branch'];
			$LatLongString = $_GET['LatLongString'];
		    $Radius = $_GET['Radius'];
			
		}
?>

	<script>
	$(document).ready(function(){
	$.ajax({
	   type: "POST",
	   url: "http://maps.icicibank.com/mobile/LEPTON/Handlers/SVCHandler.ashx?Task=GetATMData",
	   data: {
		 LatLongString:"<?php echo $LatLongString; ?>",
			  Radius:"<?php echo $Radius; ?>",
			  BranchServices:"all",
			  ATMServices:"all"},
		success: function(data){
		alert(data);
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