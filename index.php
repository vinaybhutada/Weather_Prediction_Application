<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>One Stop Destination</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="weather.js"></script>
</head>
<body>
<div id="container">
	<div id="header" align="center"> <h1>One Stop Destination</h1></div>
	<div id="leftpane">
		<table id="cityform" width="290px" height="auto" border="1" cellspacing="0" cellpadding="0" align="center"> 
				<tr align="left">
				<td colspan="4"><div id="block1">Discover:</div></td>
				<form action="connect.php" name="input" id="wform" method="post">
				<tr>
				<td align="left" style="padding-left:7px">Source</td> <td style="padding-left:7px">:</td> <td  align="right"><input type="text" name="city1" id="start"/></td>
				<td><input type="date" id="sdate"></td></tr>
				<tr>
				<td align="left" style="padding-left:7px">Destination</td> <td style="padding-left:7px">:</td> <td  align="right"><input type="text" name="city2" id="end" align="center"/></td>
				<td><input type="date" id="ddate" name="date"></td></tr>
				<tr align="right">
				<td align="left" style="padding-left:7px">Alpha</td>
				<td style="padding-left:7px">:</td>
				<td><input type="text" name="alpha" id="alpha" align="center" placeholder="Between 0.01 to 0.2" value="0.15"/></td>
				<td><input id ="buttonid" type="button" value="submit"  onclick="calcRoute();calchistorys(1,0,1);calchistorys(2,1,1);calchistorys(3,2,1);calchistorys(0,3,1);calchistorys(0,4,2);calchistorys(0,5,3);" name="submitbtn"></input></td></tr>
				<tr>
				<!--<td align="left" style="padding-left:7px">Mode of travel<td style="padding-left:7px">:</td> <td colspan="2" align="right"> 
				<select id="mode"  style="width:155px;" onchange="calcRoute()">
				<option value="DRIVING">Driving</option>
				<option value="WALKING">Walking</option>
				</select>-->
				</td> </tr>
				</form>
		</table>
	</div>	
	
	<div id="wsource">
	<table id="weatherform" style="min-width:290px; max-width:auto" height="auto" border="1" cellspacing="0" cellpadding="0" align="center"> 
				<tr align="left">
				<td colspan="3"><div id="block2"><span id="sname">Source weather:</span></div></td>
				</tr>
				<tr>
				<td><span id="source"></span><br /></td>
				</tr>
	</table>
	</div>
	<div id="wdestination">
	<table id="weatherform" style="min-width:290px; max-width:auto" height="auto" border="1" cellspacing="0" cellpadding="0" align="center"> 
				<tr align="left">
				<td colspan="3"><div id="block2"><span id="dname">Destination weather:</span></div></td>
				</tr>
				<tr>
				<td><span id="destination"></span><br /></td>
				</tr>
	</table>
	</div>
	<div id="google">&nbspTRAVELLING ROUTE:
	<div style="float:right;margin-right:10px;"><a href="efficient.php" style="color:#ffffff"> Display Analysis Chart</a></div>
	</div>
	<div id="steps"><b><i>Steps for Prediction:</i></b></div>
	<div id="directions-panel"></div>
	<div id="map-canvas"><?php include 'map.php'; ?></div>
</div>
</body>