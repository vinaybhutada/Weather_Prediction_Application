var temp_s;
var temp_d;
var hist = new Array();
var hdate = new Array();
var result = new Array();
var count = 0;

function calcweathers()
{

var cityname = document.getElementById('start').value;
document.getElementById('sname').innerHTML = cityname;
jQuery(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/a73d7dcdbcc75fbf/geolookup/conditions/q/IN/"+cityname+".json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var location = parsed_json['location']['city'];
  this.temp_s = parsed_json['current_observation']['temp_c'];
  document.getElementById('source').innerHTML = ("Current temperature is "+this.temp_s+"&degC");
  document.getElementById('steps').innerHTML += ("</br>Current temperature is "+this.temp_s+"&degC</br>");
  expsmooth('source',0,this.temp_s,3);
  calcweatherd(this.temp_s);
 }
  });
});
}

function calcweatherd(temp_s)
{
var cityname = document.getElementById('end').value;
document.getElementById('dname').innerHTML = cityname;
jQuery(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/a73d7dcdbcc75fbf/geolookup/conditions/q/IN/"+cityname+".json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var location = parsed_json['location']['city'];
  this.temp_d = parsed_json['current_observation']['temp_c'];
  //alert("Current temperature in " + location + " is: " + this.temp_d);
  document.getElementById('destination').innerHTML = ("Current temperature is "+this.temp_d+"&degC");
  document.getElementById('steps').innerHTML += ("</br>Current temperature is "+this.temp_d+"&degC</br>");
  expsmooth('destination',6,this.temp_d,9);
  submitform(this.temp_d,temp_s);
  }
  });
});
}

function calchistorys(i,j,k)
{
  var sname = $("#start").val();
  var sdatetemp = new Date($("#sdate").val());
  sdatetemp.setFullYear(sdatetemp.getFullYear()-k,sdatetemp.getMonth(),sdatetemp.getDate()-i);
  var sd = sdatetemp.toLocaleDateString();
  var sdate = sd.split("/");
  if(sdate[0]<10)
  {		sdate[0] = "0"+sdate[0];	}
  if(sdate[1]<10)
  {		sdate[1] = "0"+sdate[1];	}
  hdate[j] = sdate[2]+"-"+sdate[0]+"-"+sdate[1];
   // alert(hdate[j]);
  jQuery(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/a73d7dcdbcc75fbf/history_"+sdate[2]+sdate[0]+sdate[1]+"/q/IN/"+sname+".json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var temp_c = parsed_json['history']['dailysummary'][0]['maxtempm'];
 // alert("Current temperature in is: " + temp_c);
 document.getElementById('steps').innerHTML += ("</br>Temperature for "+sname+" for "+sd+" is "+temp_c+"&degC</br>");
  hist[j] = temp_c;
  calchistoryd(i,(j+6),k);
  }
 });
});

}

function calchistoryd(i,j,k)
{
  var dname = $("#end").val();
  var ddatetemp = new Date($("#ddate").val());
  ddatetemp.setFullYear(ddatetemp.getFullYear()-k,ddatetemp.getMonth(),ddatetemp.getDate()-i);
  var dd = ddatetemp.toLocaleDateString();
  var ddate = dd.split("/");
  if(ddate[0]<10)
  {		ddate[0] = "0"+ddate[0];	}
  if(sdate[1]<10)
  {		ddate[1] = "0"+ddate[1];	}
  hdate[j] = ddate[2]+"-"+ddate[0]+"-"+ddate[1];
  //  alert(hdate[j]);
  jQuery(document).ready(function($) {
  $.ajax({
  url : "http://api.wunderground.com/api/a73d7dcdbcc75fbf/history_"+ddate[2]+ddate[0]+ddate[1]+"/q/IN/"+dname+".json",
  dataType : "jsonp",
  success : function(parsed_json) {
  var temp_c = parsed_json['history']['dailysummary'][0]['maxtempm'];
   document.getElementById('steps').innerHTML += ("</br>Temperature for "+dname+" for "+dd+" is "+temp_c+"&degC</br>");
  //alert("Current temperature in "+dname+" is: " + temp_c);
  hist[j] = temp_c;
  if(j==11)
  {  calcweathers();  }
  }
 });
});
}

function expsmoth(name,j,ct,aw)
{
var alpha = $("#alpha").val();
var pt = "<?php echo $sql_1; ?>";
var ft; 
var d0 = "<?php echo $sql_7; ?>";
var d1 = "<?php echo $sql_8; ?>";
var d2 = "<?php echo $sql_9; ?>";
alert(d0+"\t"+d1+"\t"+d2);
ft = ((alpha*d0) + ((1-alpha)*alpha*d1) + (Math.pow((1-alpha),2)*(alpha*d2)) + (Math.pow((1-alpha),3)*pt)).toFixed(3);
document.getElementById(name).innerHTML += ("</br>Predicted temperature is "+ft+"&degC");
document.getElementById('steps').innerHTML += ("</br>Predicted temperature "+name+" is "+ft+"&degC</br>");
wmavg(name,aw);

//alert("predicted temperature: "+ft);
}

function wma(name,aw)
{
var t1 = 0.5;
var t2 = 0.3;
var t3 = 0.2;
var d1 = hist[aw+0];
var d2 = hist[aw+1];
var d3 = hist[aw+2];
var ft = ((t1*d1)+(t2*d2)+(t3*d3)).toFixed(3);
document.getElementById(name).innerHTML += ("</br>Average temperature is "+ft+"&degC");
document.getElementById('steps').innerHTML += ("</br>Average temperature "+name+" is "+ft+"&degC</br>");
//alert(d1+"\t"+d2+"\t"+d3);
}

function submitform(tempd,temps) 
{

//alert("This is database function!!!");

var sname = $("#start").val();
var sdate = $("#sdate").val();
var stemp = temps;

var dname = $("#end").val();
var ddate = $("#ddate").val();
var dtemp = tempd;

hist0 = hist[0];
hist1 = hist[1];
hist2 = hist[2];
hist3 = hist[3];
hist4 = hist[4];
hist5 = hist[5];

date0 = hdate[0];
date1 = hdate[1];
date2 = hdate[2];
date3 = hdate[3];
date4 = hdate[4];
date5 = hdate[5];

spre = result[0];
savg = result[1];
dpre = result[2];
davg = result[3];

$.post("connect.php", { sname: sname, sdate: sdate, stemp: stemp, dname: dname, ddate: ddate, dtemp: dtemp, hist0: hist0, hist1: hist1, hist2: hist2, hist3: hist3, hist4: hist4, hist5: hist5, date0: date0, date1: date1, date2: date2, date3: date3, date4: date4, date5: date5, spre: spre, savg: savg, dpre: dpre, davg: davg });
}




























































function expsmooth(name,j,ct,aw)
{
var alpha = $("#alpha").val();
var pt = ct;
var ft ; 
var d0 = hist[j+0];
var d1 = hist[j+1];
var d2 = hist[j+2];
//alert(d0+"\t"+d1+"\t"+d2);
ft = ((alpha*d0) + ((1-alpha)*alpha*d1) + (Math.pow((1-alpha),2)*(alpha*d2)) + (Math.pow((1-alpha),3)*pt)).toFixed(3);
document.getElementById(name).innerHTML += ("</br>Predicted temperature is "+ft+"&degC");
document.getElementById('steps').innerHTML += ("</br>Predicted temperature "+name+" is "+ft+"&degC</br>");
result[count++] = ft;
wmavg(name,aw);
//alert("predicted temperature: "+ft);
}

function wmavg(name,aw)
{
var t1 = 0.5;
var t2 = 0.3;
var t3 = 0.2;
var d1 = hist[aw+0];
var d2 = hist[aw+1];
var d3 = hist[aw+2];
var ft = ((t1*d1)+(t2*d2)+(t3*d3)).toFixed(3);
document.getElementById(name).innerHTML += ("</br>Average temperature is "+ft+"&degC");
document.getElementById('steps').innerHTML += ("</br>Average temperature "+name+" is "+ft+"&degC</br>");
result[count++] = ft;
//alert(d1+"\t"+d2+"\t"+d3);
}