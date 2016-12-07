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
		attend_event();
	});
/////////////////////////functions for handling ajax successes///////////////////////////
	var handleNewEvent = function(newEvent){
		//TODO: send them to a page with event stats or something
	};

	var handleLookedUpEvent = function(lookedUpEvent){
		
		
		function getDistanceFromLatLonInM(lat1,lon1,lat2,lon2, radius) {
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

		function deg2rad(deg) {
			return deg * (Math.PI/180)
		}
		
		return getDistanceFromLatLonInM(lat1, lon1, lat2, lon2, radius);
	};

	var handleNewAttendee = function(newAttendee){
		//TODO: allow attendee to actually check in
	};
//////////////////////////////////////////////////////////////////////////////////////////
});
