var url_base = "https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/checkNC.php";

var post_event = function(firstname, lastname, email, eventname, latitude, longitude, radius, numberAttending, starttime, endtime, description){
	$.ajax({type: "POST",
		url: url_base + "/MasterEventCreate",
		datatype: "json",
		data:($("#createEventForm").serialize())
		});
	};

var attend_event = function(firstname, lastname, email, eventname) {
	$.ajax({type: "POST",
		datatype: "json",
		url: url_base + "/MasterEventCheckIn",
		data:{
			"FName": firstname,
			"LName": lastname,
			"Email": email,
			"EventName": eventname
		}
		});
	};
