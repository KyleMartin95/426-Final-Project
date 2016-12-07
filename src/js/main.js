var base_url = 'https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/';

$(document).ready(function(){
	$("#createEventForm").on('submit', function(e){
		e.preventDefault();
		post_event();
	});

	$("#checkInForm").on('submit', function(e){
		e.preventDefault();
		attend_event();
	});

	var handleNewEvent = function(newEvent){
		//TODO: send them to a page with event stats or something
	};

	var handleNewAttendee = function(newAttendee){
		//TODO: allow attendee to actually check in
	};
});
