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

	$("#createEventSubmit").click(function(event){
		var eName = document.getElementById("eventName").value;
		var eDescription = document.getElementById("eventDescription").value;
		var fName = document.getElementById("hostFirstName").value;
		var lName = document.getElementById("hostLastName").value;
		var email = document.getElementById("hostEmail").value;

		//do php
		
		var empty = $(this).parent().find("input").filter(function() {
        	return this.value === "";
	    });
	    
	    if(empty.length) {
	       	alert("Please enter all fields")
	    }
	});

	$("#checkInSubmit").click(function(event){
		var empty = $(this).parent().find("input").filter(function() {
			//do php stuff here
        	return this.value === "";
	    });
	    
	    if(empty.length) {
	       	alert("Please enter event name");
	    }
	});
});