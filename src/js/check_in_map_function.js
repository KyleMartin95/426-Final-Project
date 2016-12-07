var markers = [];
var circles =[];
var latitude;
var longitude;

function myMapCheckIn() {
    //sets the div to draw the map on
    var mapCanvas = document.getElementById("map");

    //specifies custom options for map
    var mapOptions = {
        center: new google.maps.LatLng(51.508742,-0.120850),
        zoom: 5
    };

    //creates map
    var map = new google.maps.Map(mapCanvas, mapOptions);

    var infowindow = new google.maps.InfoWindow({
    });

    //gets user location and sets map to that location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            map.setCenter(pos);
            map.setZoom(15);
            placeMarker(map, pos);

        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    }else{
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

 	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                            'Error: The Geolocation service failed.' :
                            'Error: Your browser doesn\'t support geolocation.');
    }

}

// function called on click event to set a map marker at click location
function placeMarker(map, location) {
	clearMarkers();
	var marker = new google.maps.Marker({
		position: location,
		map: map
	});
	markers.push(marker);
}

function setMapOnAll(map) {
    for (var i = 0; i < circles.length; i++){
        if(i < circles.length){
            circles[i].setMap(map);
        }
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
}

function clearCircles(){
    setMapOnAll(null);
}

function placeCircle(map, location){
    debugger;
    clearCircles();
	var circle = new google.maps.Circle({
		map: map,
		center: location,
		radius: 50,
		strokeColor: "#0000FF",
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: "#0000FF",
		fillOpacity: 0.2,
		editable: true
	});
    circles.push(circle);
}

function getCircleRadius(circle){
    return radius = circle.radius;
}

function getCircleCenter(circle){
    return center = circle.center;
}

function getAttendeeLat(){
  return latitude;
}

function getAttendeeLong(){
  return longitude;
}

//function called on click event to set long and lat on the form for submission
function setLatLong(location){
	longitude = location.lng();
	latitude = location.lat();
}
