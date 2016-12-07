var url_base = "https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/checkNC.php";

$(document).ready(function(){
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
				handleLookedUpEvent(lookedUpEvent);
			},
			error: function(){
				alert("error looking up event");
			}
		});
	}

	var attend_event = function() {
		$.ajax({type: "POST",
			datatype: "json",
			url: url_base + "/MasterEventCheckIn",
			data:	($("#checkInForm").serialize()),
			success: function(newAttendee){
				handleNewAttendee(newAttendee);
			},
			error: function(){
				alert("error adding attendee");
			}
		});
	};
});
