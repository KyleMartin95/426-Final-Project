var url_base = "https://wwwp.cs.unc.edu/Courses/comp426-f16/users/kykyle/Final_Project/src/RESTfulAPI/EventAPI.php";


var post_event = function(firstname, lastname, email, eventname, latitude, longitude, radius, numberAttending, starttime, endtime, description){
	$.ajax(url_base + "/MasterEventCreate",
	{type: "POST",
		datatype: "json",
		data:{
			"FName": firstname,
			"LName": lastname,
			"Email": email,
			"EventName": eventname,
			"Latitude": latitude,
			"Longitude": longitude,
			"Radius": radius,
			"NumberAttending": numberAttending,
			"StartTime": starttime,
			"EndTime": endtime,
			"Description": description
		},
		});
	};

var attend_event = function(firstname, lastname, email, eventname) {
	$.ajax(url_base + "/MasterEventCheckIn",
	{type: "POST",
		datatype: "json",
		data:{
			"FName": firstname,
			"LName": lastname,
			"Email": email,
			"EventName": eventname
		},
		});
	};

