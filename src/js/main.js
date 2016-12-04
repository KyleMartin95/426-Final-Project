var base_url = 'https://wwwp.classroom.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RestfulAPI';

$(document).ready(function(){
	debugger;

	$("#createEventButton").click(function(event){
		$("#createEventInfo").toggle("slow");
		$("#checkInContainer").toggle("slow");
	});

	$("#checkInButton").click(function(event){
		$("#checkInInfo").toggle("slow");
		$("#createEventContainer").toggle("slow");
	});

	$("#createEventSubmit").on('submit', event_submit_handler);

	$("#checkInSubmit").on('submit', event_checkin_handler);

	var eventName = $("#eventName");
	var eventDescription = $("#eventDescription");
	var startTime = $("#startTime");
	var endTime = $("#endTime");
	var hostFirstName = $("#hostFirstName");
	var hostLastName = $("#hostLastName");
	var hostEmail = $("#hostEmail");
	var latitude = $("#latitude");
	var longitude = $("#longitude");

	var event_submit_handler = function(e){
		e.preventDefault();

		var eventData = {
			eventName: eventName,
			eventDescription: eventDescription,
			startTime: startTime,
			endTime: endTime,
			firstName: hostFirstName,
			lastName: hostLastName,
			email: hostEmail,
			latitude: latitude,
			longitude: longitude
		}

		$.ajax({
			type: 'POST',
			url: base_url + 'RESTfulAPI/EventSubmit.php',
			data: eventData,
			success: function(newEvent){
				//do stuff to update map and whatnot
			},
			error: function(){
				alert('error creating event');
			}
		});
	}

	var findEventName = $("#findEventName");
	var attendeeFirstName = $("#attendeeFirstName");
	var attendeeLastName = $("#attendeeLastName");
	var attendeeEmail = $("#attendeeEmail");

	var event_checkin_handler = function(e){
		e.preventDefault();

		var findEventData = {
			eventName: findEventName,
			firstName: attendeeFirstName,
			lastName: attendeeLastName,
			email: attendeeEmail
		}

		$.ajax({
			type: 'POST',
			url: base_url + 'RestfulAPI/AttendeeSubmit.php',
			data: findEventData,
			success: function(newAttendee){
				// do stuff
			},
			error: function(){
				alert('error submitting attendee');
			}
		});
	}

});
