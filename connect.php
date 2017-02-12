<script src="weather.js"></script>

<?php

$con=mysqli_connect("localhost","root","","wforecast") or die("ERR: Connection");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  $scity= $_POST['sname'];
  $sdate= $_POST['sdate'];
  $stemp= $_POST['stemp'];

  $dcity= $_POST['dname'];
  $ddate= $_POST['ddate'];
  $dtemp= $_POST['dtemp'];

  $hist0= $_POST['hist0'];
  $hist1= $_POST['hist1'];
  $hist2= $_POST['hist2'];
  $hist3= $_POST['hist3'];
  $hist4= $_POST['hist4'];
  $hist5= $_POST['hist5'];
  
  $date0 = $_POST['date0'];
  $date1 = $_POST['date1'];
  $date2 = $_POST['date2'];
  $date3 = $_POST['date3'];
  $date4 = $_POST['date4'];
  $date5 = $_POST['date5'];
  
  $spre = $_POST['spre'];
  $savg = $_POST['savg'];
  $dpre = $_POST['dpre'];
  $davg = $_POST['davg'];


$sql_1="INSERT INTO source (name,date,cw,pw,aw) VALUES('$scity','$sdate','$stemp','$spre','$savg')";      

$sql_2="INSERT INTO destination (name,date,cw,pw,aw) VALUES('$dcity','$ddate','$dtemp','$dpre','$davg')";

$sql_3="INSERT INTO history (name,date,temp) VALUES('$scity','$date0','$hist0')";

$sql_4="INSERT INTO history (name,date,temp) VALUES('$scity','$date1','$hist1')";

$sql_5="INSERT INTO history (name,date,temp) VALUES('$scity','$date2','$hist2')";

$sql_6="INSERT INTO history (name,date,temp) VALUES('$dcity','$date3','$hist3')";

$sql_7="INSERT INTO history (name,date,temp) VALUES('$dcity','$date4','$hist4')";

$sql_8="INSERT INTO history (name,date,temp) VALUES('$dcity','$date5','$hist5')"; 

$sql_9="ALTER TABLE history ORDER BY `name` ASC";


if (!mysqli_query($con,$sql_1))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_2))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_3))
  {
  die('Error: ' . mysqli_error($con));
  }
 
if (!mysqli_query($con,$sql_4))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_5))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_6))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_7))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_8))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  if (!mysqli_query($con,$sql_9))
  {
  die('Error: ' . mysqli_error($con));
  }
  
  
  mysqli_close($con);

?>