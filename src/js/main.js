var url_base = "https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/checkNC.php";


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
		$("#submitEventName").val($("#findEventName").val());
		attend_event();
	});

	var post_event = function(){
		$.ajax({type: "POST",
			url: url_base + "/MasterEventCreate",
			datatype: "json",
			data:($("#createEventForm").serialize()),
			success: function(newEvent){
				handleNewEvent(newEvent);
			},
			error: function(){
				alert("error creating event");
			}
		});
	};

	var look_up_event = function(){
		$.ajax({
			type: "GET",
			url: url_base + "/EventInfo",
			datatype: "json",
			data: ($("#eventLookUpForm").serialize()),
			success: function(lookedUpEvent){
				var lat = lookedUpEvent.latitude;
				var lon = lookedUpEvent.longitude;
				var radius = lookedUpEvent.radius;
				var curLat = getAttendeeLat();
				var curLon = getAttendeeLong();

				displayLookedUpEvent(lat, lon, radius);

				var canCheckIn = false; //controls whether attendee can check into current event
										//set to false at first since no event has been looked up
				function getDistanceFromLatLonInM(lat1, lon1, lat2, lon2, radius) {
					console.log(lat1, lon1, lat2, lon2, radius);
					var R = 6371; // Radius of the earth in km
					var dLat = deg2rad(lat2-lat1);  // deg2rad below
					var dLon = deg2rad(lon2-lon1);
					console.log(dLat, dLon);
					var a =
						Math.sin(dLat/2) * Math.sin(dLat/2) +
						Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
						Math.sin(dLon/2) * Math.sin(dLon/2);
					var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
					var d = R * c; // Distance in km
					console.log(radius, d);
					return radius > d * 1000;
				}

				function deg2rad(deg) {
					return deg * (Math.PI/180)
				}

				canCheckIn = getDistanceFromLatLonInM(lat,lon,curLat,curLon, radius);

				if(canCheckIn){
					$("#eventCheckInInfo").toggle("fast")
					$("#checkInInfo").toggle("fast");
				}else{
					alert("You're not at the event! Please go to it and try to check in a again");
				}
			},
			error: function(){
				alert("error looking up event");
			}
		});
	};

	var attend_event = function() {
		$.ajax({type: "POST",
			datatype: "json",
			url: url_base + "/MasterEventCheckIn",
			data:	($("#checkInForm").serialize()),
			success: function(newAttendee){
				alert("Thanks for checking in!")
			},
			error: function(){
				alert("error adding attendee");
			}
		});
	};


/////////////////////////functions for handling ajax successes///////////////////////////
	var handleNewEvent = function(newEvent){
		//TODO: send them to a page with event stats or something
	};

	var handleLookedUpEvent = function(lookedUpEvent){

	};

	var handleNewAttendee = function(newAttendee){

	};

//////////////////////////////////////////////////////////////////////////////////////////
});
