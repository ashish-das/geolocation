<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php

date_default_timezone_set('UTC');
require('C:/xampp/htdocs/GeoLocation/xlsx/XLSXReader.php');
include_once("C:/xampp/htdocs/GeoLocation/writer/xlsxwriter.class.php");


$xlsx = new XLSXReader('C:/xampp/htdocs/GeoLocation/excelfiles/hdfccitylist2.xlsx');
set_time_limit ( 0 );
//Brancheslist

$sheetNames = array_values($xlsx->getSheetNames());
	$colCount = $xlsx->getSheet($sheetNames[0])->colCount;
	$rowCount = $xlsx->getSheet($sheetNames[0])->rowCount;
	$data = $xlsx->getSheetData($sheetNames[0]);
	
	$code = Array();

	/*echo '<pre>';
	print_r($data);
	exit;*/
for($row=91;$row<=118;$row++)
{
	$branch =  substr($data[$row][0],0) . ",Andhra Pradesh";
	$LatLongString = "";
	$Radius = 10;
	?>
	<script>
	     // $.ajax({
	    // type: "GET",
	   // url: "index1.php?branch=<?php echo $branch ?>&LatLongString=<?php echo $LatLongString ?>&Radius=2",
		 // success: function(data){
		 // //alert(data);
		  // //$("#locatorStr").val(data);
			 // //    alert($("#locatorStr").val());
				 // //$("#frm").submit();
					
	    // }
	 // });
	window.open("index1.php?branch=<?php echo $branch ?>&LatLongString=<?php echo $LatLongString ?>&Radius=10",'_blank');
	 //alert("Click Ok To pRocess");
	</script>
	<?php
}

?>