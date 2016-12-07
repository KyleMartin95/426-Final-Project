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
		$("#checkInInfo").toggle("slow");

		var latitude = lookedUpEvent.latitude;
		var longitude = lookedUpEvent.longitude;
		var radius = lookedUpEvent.radius;

		displayLookedUpEvent(latitude, longitude, radius);

	};

	var handleNewAttendee = function(newAttendee){
		//TODO: allow attendee to actually check in
	};
//////////////////////////////////////////////////////////////////////////////////////////
});
