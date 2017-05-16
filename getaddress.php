<?php
require('C:/xampp/htdocs/GeoLocation/xlsx/XLSXReader.php');
function getaddress($lat,$lng)
{
$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
$json = @file_get_contents($url);
$data=json_decode($json);
$status = $data->status;
if($status=="OK")
return $data->results[0]->formatted_address;
else
return false;
}
?>

<?php

$xlsx = new XLSXReader('C:/xampp/htdocs/GeoLocation/excelfiles/hdfcap.xlsx');
set_time_limit ( 0 );
//Brancheslist

	$sheetNames = array_values($xlsx->getSheetNames());
	$colCount = $xlsx->getSheet($sheetNames[0])->colCount;
	$rowCount = $xlsx->getSheet($sheetNames[0])->rowCount;
	$data = $xlsx->getSheetData($sheetNames[0]);
	
	for ($i=0; $i < $rowCount; $i++) { 
		# code...
		$lat = substr($data[$i][0],0);
		$lng = substr($data[$i][1],0);
		echo $lat." ----> ".$lng."\n";
		$d = "";
		$address = getaddress($lat,$lng);
		if($address)
		{
			$d = $lat.",".$lng.",".$address;
			$file = fopen("address.csv","a");
			fwrite($file,$d."\n");
		}
		
		echo $address;
		echo "<hr>";
	}
?>