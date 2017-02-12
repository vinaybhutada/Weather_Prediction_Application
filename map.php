<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="http://j.maxmind.com/app/geoip.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
var geocoder;
var infowindow = new google.maps.InfoWindow();
var map;
var lat = geoip_latitude();
var lon = geoip_longitude();
var mylatlng = new google.maps.LatLng(lat, lon);
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();

function initialize() {
  geocoder = new google.maps.Geocoder();
  directionsDisplay = new google.maps.DirectionsRenderer();
  var bhopal = new google.maps.LatLng(23.2500, 77.4167);
  var mapOptions = {
    zoom:5,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: bhopal
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
  
   /*var image = 'homemap.png';
   var marker = new google.maps.Marker({
      position: mylatlng,
      map: map, 
	  icon: image,
      title: 'mumbai',
	  animation: google.maps.Animation.BOUNCE
   });*/
   
  codeLatLng();
  
  directionsDisplay.setPanel(document.getElementById('directions-panel'));

  var control = document.getElementById('control');
  control.style.display = 'block';
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
}

function codeLatLng() {
  var image = 'homemap.png';
  geocoder.geocode({'latLng': mylatlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        map.setZoom(6);
        marker = new google.maps.Marker({
            position: mylatlng,
            map: map,
			icon: image,
			animation: google.maps.Animation.BOUNCE
        });
        infowindow.setContent(results[1].formatted_address);
        infowindow.open(map, marker);
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });
}

function calcRoute() {
  document.getElementById('steps').innerHTML = ("<b><i>Steps for Prediction:</i></b></br>");
  var start = document.getElementById('start').value;
  var end = document.getElementById('end').value;
  var selectedMode = "DRIVING"; //document.getElementById('mode').value;
  var request = {
      origin:start,
      destination:end,
	  travelMode: google.maps.TravelMode[selectedMode]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>