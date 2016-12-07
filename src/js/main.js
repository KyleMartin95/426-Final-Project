var base_url = 'https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/';

$(document).ready(function(){
	$("#createEventForm").on('submit', function(e){
		e.preventDefault();
		post_event();
	});

	$("#eventLookUpForm").on('submit', function(e){
		e.preventDefault();
		look_up_event();
	});

	$("#checkInForm").on('submit', function(e){
		e.preventDefault();
		if(canCheckIn) {
			attend_event();
			alert("You've checked in!")
		}else {
			alert("You are not within the event's radius. Move closer to it!")
		}
	});
/////////////////////////functions for handling ajax successes///////////////////////////
	var handleNewEvent = function(newEvent){
		//TODO: send them to a page with event stats or something
	};

	var canCheckIn = false; //controls whether attendee can check into current event
							//set to false at first since no event has been looked up
	
	var handleLookedUpEvent = function(lookedUpEvent){
		var lat = lookedUpEvent.latitude;
		var lon = lookedUpEvent.longitude;
		var radius = lookedUpEvent.radius;
		var curLat = getAttendeelat();
		var curLon = getAttendeeLong();
		
		function getDistanceFromLatLonInM(lat1, lon1, lat2, lon2, radiu) {
			var R = 6371; // Radius of the earth in km
			var dLat = deg2rad(lat2-lat1);  // deg2rad below
			var dLon = deg2rad(lon2-lon1); 
			var a = 
				Math.sin(dLat/2) * Math.sin(dLat/2) +
				Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
				Math.sin(dLon/2) * Math.sin(dLon/2); 
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			var d = R * c; // Distance in km
			return radius > d * 1000;
		}

		$("#checkInInfo").toggle("slow");

		displayLookedUpEvent(lat, lon, radius);

		function deg2rad(deg) {
			return deg * (Math.PI/180)
		}
		
		canCheckIn = getDistanceFromLatLonInM(lat,lon,curLat,curLon, radius);
	};
	
	var handleNewAttendee = function(newAttendee){

	};
//////////////////////////////////////////////////////////////////////////////////////////
});
