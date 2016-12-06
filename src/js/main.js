var base_url = 'https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/';

$(document).ready(function(){

	$("#createEventButton").click(function(event){
		$("#createEventInfo").toggle("slow");
		$("#checkInContainer").toggle("slow");
	});

	$("#checkInButton").click(function(event){
		$("#checkInInfo").toggle("slow");
		$("#createEventContainer").toggle("slow");
	});

	$("#createEventForm").on('submit', function(e){
		e.preventDefault();


		/*var eventName = $("#eventName").val();
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

		console.log($('#createEventForm').serializeArray());

		$.ajax({
			type: "POST",
			dataType: "json",
			url: base_url + "EventPost.php",
			data: $('#createEventForm').serializeArray(),
			success: function(newEvent){
				alert("success: created event");
			},
			error: function(){
				debugger;
				alert('error creating event');
			}
		});*/

    // Get URL from rest_url text input
    var ajax_url = base_url + "EventPost.php";

    // Set up settings for AJAX call
    var settings = {
			type: "POST",
			data: data,
			success: ajax_success_handler,
			error: ajax_error_handler,
			cache: false
    }

    // Make AJAX call
    $.ajax(ajax_url, settings);
	});

	var ajax_success_handler = function(data, textStatus, jqXHR) {
	    /*$('#returnstatus').html(jqXHR.status);
	    $('#returntext').html(jqXHR.responseText);*/
			alert("success");
	};

	var ajax_error_handler = function(jqXHR, textStatus, errorThown) {
	    $('#returnstatus').html(jqXHR.status);
	    $('#returntext').html(jqXHR.responseText);
	};

	$("#checkInSubmit").on('submit', event_checkin_handler);

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
