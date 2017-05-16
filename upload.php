<?php
date_default_timezone_set('UTC');
require('C:/xampp/htdocs/GeoLocation/xlsx/XLSXReader.php');
include_once("C:/xampp/htdocs/GeoLocation/writer/xlsxwriter.class.php");


$xlsx = new XLSXReader('C:/xampp/htdocs/GeoLocation/excelfiles/excel.xlsx');
set_time_limit ( 0 );


$sheetNames = array_values($xlsx->getSheetNames());
	$colCount = $xlsx->getSheet($sheetNames[0])->colCount;
	$rowCount = $xlsx->getSheet($sheetNames[0])->rowCount;
	$data = $xlsx->getSheetData($sheetNames[0]);

	$code = Array();

	/*echo '<pre>';
	print_r($data);
	exit;*/
for($row=0;$row<$rowCount;$row++)
{
	$branch = substr($data[$row][0],0) .",Telangana";
	echo $branch;
	echo "<hr>";
	
   
	if(!empty($branch))
	{
		$pincode="";
		
		$val = getLnt($branch);
		if(isset($val['address_components'][4]['long_name']))
		{
		$pincode = $val['address_components'][4]['long_name'];
		}
		$Latitude = $val['geometry']['location']['lat'];
		$Longitude = $val['geometry']['location']['lng'];
		//echo $pincode.",".$Latitude. "," . $Longitude . "\n";
		$code[] = Array($branch,$pincode,$Latitude,$Longitude);
	}
}

// echo '<pre>';
// print_r($code);
XLSXwriter($code);
   

function XLSXwriter($code)
{
	$header = array(
	'branch'=>'string',
    'zipcode'=>'string',
    'lat'=>'string',
    'log'=>'string',
);

$writer = new XLSXWriter();
$writer->setAuthor('Some Author');
$writer->writeSheet($code,'Sheet1',$header);
//$writer->writeSheet($data2,'Sheet2');
$writer->writeToFile('newgeolocation.xlsx');
}

function getLnt($zip){
$url = "http://maps.googleapis.com/maps/api/geocode/json?address="
.urlencode($zip)."&sensor=false";
$result_string = file_get_contents($url);
$result = json_decode($result_string, true);
$result1[]=$result['results'][0];
// $result2[]=$result1[0]['geometry'];
// $result3[]=$result2[0]['location'];
return $result1[0];
}


?>
