var base_url = 'https://wwwp.classroom.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RestfulAPI';

$(document).ready(function(){

	$("#createEventButton").click(function(event){
		$("#createEventInfo").toggle("slow");
		$("#checkInContainer").toggle("slow");
	});

	$("#checkInButton").click(function(event){
		$("#checkInInfo").toggle("slow");
		$("#createEventContainer").toggle("slow");
	});

	$("#createEventForm").submit(function(){
		debugger;
		event_submit_handler();
	});

	$("#checkInSubmit").on('submit', event_checkin_handler);



	var event_submit_handler = function(e){
		debugger;

		var eventName = $("#eventName").val();
		var eventDescription = $("#eventDescription").val();
		var startTime = $("#startTime").val();
		var endTime = $("#endTime").val();
		var hostFirstName = $("#hostFirstName").val();
		var hostLastName = $("#hostLastName").val();
		var hostEmail = $("#hostEmail").val();
		var latitude = $("#latitude").val();
		var longitude = $("#longitude").val();
		var radius = $("#radius").val();

		var eventData = {
			"eventName": eventName,
			"eventDescription": eventDescription,
			"startTime": startTime,
			"endTime": endTime,
			"firstName": hostFirstName,
			"lastName": hostLastName,
			"email": hostEmail,
			"latitude": latitude,
			"longitude": longitude,
			"radius": radius
		}

		$.ajaxSetup({
		    async: true
		});

		$.ajax({
			type: 'POST',
			dataType: "json",
			url: base_url + 'RESTfulAPI/EventPost.php',
			data: eventData,
			success: function(newEvent){
				alert("success: created event");
			},
			error: function(){
				alert('error creating event');
			}
		});
	}

	var event_checkin_handler = function(e){
		e.preventDefault();

		var findEventName = $("#findEventName").val();
		var attendeeFirstName = $("#attendeeFirstName").val();
		var attendeeLastName = $("#attendeeLastName").val();
		var attendeeEmail = $("#attendeeEmail").val();

		var findEventData = {
			"eventName": findEventName,
			"firstName": attendeeFirstName,
			"lastName": attendeeLastName,
			"email": attendeeEmail
		}

		$.ajax({
			type: 'POST',
			url: base_url + 'RestfulAPI/AttendeePost.php',
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
