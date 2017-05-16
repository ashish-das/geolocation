<?php
	$location = "Kukatpally, Hyderabad, Telangana";
	$LatLongString = "17.4947934,78.39964409999993";
	$Radius = 2;
?>
<input type="button" id="btnExport" value=" Export Table data into Excel " />

<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
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
			  var dt = data.split('$');
				var dt1 = dt[0].split('^');
				alert(dt1);
				var tabledata = "<tr><th>Latitude</th><th>Longitude</th><th>Address</th><th>Pincode</th></tr><tr>";
				
				
					tabledata +="<td>"+dt1[0]+"</td>" ;
					tabledata +="<td>"+dt1[1]+"</td>" ;
					tabledata +="<td>"+dt1[2]+dt1[3]+dt1[4]+dt1[5]+"</td>" ;
					tabledata +="<td>"+dt1[8]+"</td>" ;
				
				tabledata +="</tr>"
		  // alert(dt1.length);
		  document.getElementById('bankdata').innerHTML  = tabledata;
		 
		  
	  }
	});
});
$("#btnExport").click(function (e) {
	alert("ashish");
	 window.open('data:application/vnd.ms-excel,' + $('#mydata').html());
			e.preventDefault();
}
);
</script>
<div id="mydata">
	<table id="bankdata" border =1>
	</table>
</div>

