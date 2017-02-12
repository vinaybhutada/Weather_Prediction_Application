<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script> 
<script>
function calcweather()
{
  var temp_c;
//var cityname = document.getElementById(arr[z]).value;
  jQuery(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/a73d7dcdbcc75fbf/history_20140228/q/IN/pune.json",
  dataType : "jsonp",
  success : function(parsed_json) {
 // var location = parsed_json['location']['city'];
  temp_c = parsed_json['history']['dailysummary'][0]['maxtempm'];
  alert("Current temperature in  is: " + temp_c);
  //document.getElementById(arr[3]).innerHTML = ("Current temperature in "+cityname+" is "+temp_c);
  }
 });
});
}


</script>
</head>
<body>
				<form name="sample" method="post">
				<input id ="buttonid" type="button" value="submit" onClick="calcweather();" name="submitbtn"></input>
				</form>
</body>
</html>
