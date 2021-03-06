var markers = [];

function myMap() {
    debugger;



    //sets the div to draw the map on
    var mapCanvas = document.getElementById("map");
    
    //specifies custom options for map
    var mapOptions = {
        center: new google.maps.LatLng(51.508742,-0.120850),
        zoom: 5
    };
    
    //creates map
    var map = new google.maps.Map(mapCanvas, mapOptions);


    //gets user location and sets map to that location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            setLatLongGeo(position);
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

    //adds click listener and calls functions that set a marker and specifies lat long at click location
   	map.addListener('click', function(e) {
  		placeMarker(map, e.latLng);
  		setLatLong(e.latLng);
  	});
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
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
}

//function called on click event to set long and lat on the form for submission
function setLatLong(location){
	document.getElementById("longitude").value = location.lng();
	document.getElementById("latitude").value = location.lat();
}

////function called on geolocating event to set long and lat on the form for submission
function setLatLongGeo(position){
	document.getElementById("longitude").value = position.coords.longitude;
	document.getElementById("latitude").value = position.coords.latitude;
}

