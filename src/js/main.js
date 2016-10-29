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
		var empty = $(this).parent().find("input").filter(function() {
			//do php stuff here
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