<?php

//add filtering paramaters for Get index

require_once('ORM/EventInfo_2_Person.php');
require_once('ORM/EventInfo.php');
require_once('ORM/Person.php');
require_once('ORM/MasterEventCreate.php');
require_once('ORM/MasterEventCheckIn.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);
$resource_type = $resource_components[1];

switch($resource_type) {
	case "MasterEventCreate" :
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			if ((count($path_components) != 2)){
			header("HTTP/1.0 404 Not Found");
		   	print("Incorrect POST Request");
  			exit();
		   	}
			if (!isset($_REQUEST['FName'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing first name");
      			exit();
    			}
			$fName = trim($_REQUEST['FName']);

			if (!isset($_REQUEST['LName'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing last name");
      			exit();
			}
			$lName = trim($_REQUEST['LName']);

			if (!isset($_REQUEST['Email'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing email");
      			exit();
    			}
			$email = trim($_REQUEST['Email']);

			if (!isset($_REQUEST['EventName'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing event name");
      			exit();
    			}
			$eventName = trim($_REQUEST['EventName']);

			if (!isset($_REQUEST['Latitude'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing latitude");
      			exit();
    			}
			$latitude = trim($_REQUEST['Latitude']);

			if (!isset($_REQUEST['Longitude'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing longitude");
      			exit();
    			}
			$longitude = trim($_REQUEST['Longitude']);

			if (!isset($_REQUEST['Radius'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing radius");
      			exit();
    			}
			$radius = trim($_REQUEST['radius']);

			if (!isset($_REQUEST['NumberAttending'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing number attending");
      			exit();
    			}
			$numberAttending = trim($_REQUEST['NumberAttending']);

			if (!isset($_REQUEST['StartTime'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing start time");
      			exit();}
			$startTime = trim($_REQUEST['StartTime']);

			if (!isset($_REQUEST['EndTime'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing end time");
      			exit();}
			$endTime = trim($_REQUEST['EndTime']);

			if (!isset($_REQUEST['Description'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing latitude");
      			exit();}
			$description = trim($_REQUEST['Description']);

			$new_event = MasterEventCreate::insert($fName, $lName, $email, $eventName, $latitude, $longitude, $radius, $numberAttending, $startTime, $endTime, $description);

			if($new_event == null){
			header("HTTP/1.0 500 Server Error");
     			print("Server couldn't create your event. Check your parameters");
     			exit();
			}

			header("Content-type: application/json");
			print($new_event->getJSON());
			exit();
		}
	else {
	//print bad statement
}
	break;

	case "MasterEventCheckIn" :
		if ($_SERVER['REQUEST_METHOD'] == "POST"){
			if (!isset($_REQUEST['FName'])) {
      			header("HTTP/1.0 400 Bad Request");
      			print("Missing first name");
      			exit();
   		 	}

			$fName = trim($_REQUEST['FName']);

			if (!isset($_REQUEST['LName'])) {
 		     	header("HTTP/1.0 400 Bad Request");
		      	print("Missing last name");
 		     	exit();
 		   	}

			$lName = trim($_REQUEST['LName']);

			if (!isset($_REQUEST['Email'])) {
 		     	header("HTTP/1.0 400 Bad Request");
 		     	print("Missing email");
  		    	exit();
 		   	}

			$email = trim($_REQUEST['Email']);

			if (!isset($_REQUEST['EventName'])) {
 		     	header("HTTP/1.0 400 Bad Request");
 		     	print("Missing event name");
 		     	exit();
 		   	}

			$eventName = trim($_REQUEST['EventName']);


			$new_checkin = MasterEventCheckIn::insert($fName, $lName, $email, $eventName);

			if($new_checkin == null){
			header("HTTP/1.0 500 Server Error");
 		    	print("Server couldn't check you into the event. Check your parameters.");
 		    	exit();
			}

			header("Content-type: application/json");
			print($new_checkin->getJSON());
			exit();

		}
		else{
		//print bad statement
		}
	break;

	case "Person" :
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
		   if( (count($path_components) == 3) && $path_components[2] !== ""){
			$person_id = intval($path_components[2]);
			$person = Person::findByID($person_id);

			if ($person == null) {
     				header("HTTP/1.0 404 Not Found");
      				print("Person id: " . $person_id . " not found.");
      				exit();
    			}

			header('Content-Type: application/json');
			print($person->getJSON());
			exit();

			}
		   else if ((count($path_components) == 2)){
			if (isset($_REQUEST['Email'])) {
      			header("Content-type: application/json");
  				print(json_encode(Person::getIDs($_REQUEST['Email'])));
  				exit();
    			}

       			header("Content-type: application/json");
  			print(json_encode(Person::getAllIDs()));
  			exit();
		   }

		   header("HTTP/1.0 404 Bad Request");
		   print("Incorrect GET Request");
		}
		else if ($_SERVER['REQUEST_METHOD'] == "PUT"){
			if ((count($path_components) == 3) && $path_components[2] !== ""){
				header("HTTP/1.0 404 Bad Request");
		   		print("Incorrect PUT Request");
  				exit();
		   	}

			$person_id = intval($path_components[2]);
			$person = Person::findByID($person_id);

			if($userleaderboard == null){
				header("HTTP/1.0 404 Not Found");
      				print("Person id: " . $person_id . " not found while attempting update.");
      				exit();
			}

			$new_fname = false;
			$new_lname = false;
			$new_email = false;

			if(isset($_REQUEST['FirstName'])){
			  $new_fname = trim($_REQUEST['FirstName']);
			  if ($new_fname == "") {
				header("HTTP/1.0 400 Bad Request");
				print("Bad first name");
				exit();
      			  }
			}

			if(isset($_REQUEST['LastName'])){
			  $new_lname = trim($_REQUEST['LastName']);
			  if ($new_lname == "") {
				header("HTTP/1.0 400 Bad Request");
				print("Bad last name");
				exit();
      			  }
			}

			if(isset($_REQUEST['Email'])){
			  $new_email = trim($_REQUEST['Email']);
			  if ($new_email == "") {
				header("HTTP/1.0 400 Bad Request");
				print("Bad fname");
				exit();
      			  }
			}

			if($new_fname){
			  $person->setFName($new_fname);
			}
			if($new_lname){
			  $person->setLName($new_lname);
			}
			if($new_email){
			  $person->setEmail($new_email);
			}

    			header("Content-type: application/json");
    			print($person->getJSON());
    			exit();

		}
		else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){

		   	if(count($path_components) == 3){
			  $person_id = intval($path_components[2]);
			  $person = Person::findByID($person_id);
			  $person->delete();
			  header("Content-type: application/json");
      			  print(json_encode(true));
			  exit();
			}
			header("HTTP/1.0 404 Bad Request");
			print("Incorrect DELETE Request");
		}
	break;

	case “EventInfo” :
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
		   if( (count($path_components) == 3) && $path_components[2] !== ""){
			$eventinfo_id = intval($path_components[2]);
			$eventinfo = EventInfo::findByID($eventinfo_id);
			if ($eventinfo == null) {
      				// User not found.
     				header("HTTP/1.0 404 Not Found");
      				print("EventInfo id: " . $eventinfo_id . " not found.");
      				exit();
    			   }

			header('Content-Type: application/json');
			print($settings->getJSON());
			exit();

			}
		   else if (count($path_components) == 2){
			if (isset($_REQUEST['EventName'])) {
      			header("Content-type: application/json");
  				print(json_encode(EventInfo::getIDs($_REQUEST['eventName'])));
  				exit();
    			}
			header("Content-type: application/json");
  			print(json_encode(EventInfo::getAllIDs()));
  			exit();
		   }

		   header("HTTP/1.0 404 Bad Request");
		   print("Incorrect GET Request");
		}
		else if ($_SERVER['REQUEST_METHOD'] == "PUT"){
			if ((count($path_components) == 3) && $path_components[2] !== ""){
				header("HTTP/1.0 404 Bad Request");
		   		print("Incorrect PUT Request");
  				exit();
		   	}

			$eventinfo_id = intval($path_components[2]);
			$eventinfo = EventInfo::findByID($eventinfo_id);

			if($eventinfo == null){
				header("HTTP/1.0 404 Not Found");
      				print("EventInfo id: " . $eventinfo_id . " not found while attempting update.");
      				exit();
			}

			$new_eventName = false;
			$new_latitude = false;
			$new_longitude = false;
			$new_radius = false;
			$new_numberAttending = false;
			$new_hostID = false;
			$new_startTime = false;
			$new_endTime = false;
			$new_description = false;


			if(isset($_REQUEST['EventName'])){
			  $new_eventName = trim($_REQUEST['eventName']);
			  if ($new_eventName == "") {
				header("HTTP/1.0 400 Bad Request");
				print("Bad eventName");
				exit();
      			  }
			}

			if(isset($_REQUEST['Latitude'])){
			  $new_latitude = trim($_REQUEST['Latitude']);
			  if ($new_latitude <= 0) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad latitude");
				exit();
      			  }
			}

			if(isset($_REQUEST['Longitude'])){
			  $new_longitude = trim($_REQUEST['Longitude']);
			  if ($new_longitude <= 0) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad longitude");
				exit();
      			  }
			}


			if(isset($_REQUEST['Radius'])){
			  $new_radius = $_REQUEST['Radius'];
			  if ($new_radius <=0 ) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad radius");
				exit();
      			  }
			}

			if(isset($_REQUEST['NumberAttending'])){
			  $new_numberAttending = $_REQUEST['NumberAttending'];
			  if ($new_numberAttending <=0 ) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad numberAttending");
				exit();
      			  }
			}

			if(isset($_REQUEST['HostID'])){
			  $new_hostID = $_REQUEST['HostID'];
			  if ($new_hostID <=0 ) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad hostID");
				exit();
      			  }
			}


			if(isset($_REQUEST['StartTime'])){
			  $new_startTime = trim($_REQUEST['StartTime']);
			  if ($new_startTime <= 0) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad backgroundColor");
				exit();
      			  }
			}

			if(isset($_REQUEST['EndTime'])){
			  $new_endTime = trim($_REQUEST['EndTime']);
			  if ($new_endTime <= 0) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad endTime");
				exit();
      			  }
			}

			if(isset($_REQUEST['Description'])){
			  $new_description = trim($_REQUEST['Description']);
			  if ($new_description == "") {
				header("HTTP/1.0 400 Bad Request");
				print("Bad description");
				exit();
      			  }
			}

			if($new_eventName){
			  $eventinfo->setUserID($new_userID);
			}
			if($new_latitude){
			  $eventinfo->setLatitude($new_latitude);
			}
			if($new_longitude){
			  $eventinfo->setLongitude($new_longitude);
			}
			if($new_radius){
			  $eventinfo->setRadius($new_radius);
			}
			if($new_numberAttending){
			  $eventinfo->setNumberAttending($new_numberAttending);
			}
			if($new_hostID){
			  $eventinfo->setHostID($new_hostID);
			}
			if($new_startTime){
			  $eventinfo->setStartTime($new_startTime);
			}
			if($new_endTime){
			  $eventinfo->setEndTime($new_endTime);
			}
			if($new_description){
			  $eventinfo->setDescription($new_description);
			}

    			header("Content-type: application/json");
    			print($EventInfo->getJSON());
    			exit();

		}
		else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){

		   	if(count($path_components) == 3){
			  $eventinfo_id = intval($path_components[2]);
			  $eventinfo = Settings::findByID($eventinfo_id);
			  $eventinfo->delete();

			  header("Content-type: application/json");
      			  print(json_encode(true));
			  exit();
			}
			header("HTTP/1.0 404 Bad Request");
			print("Incorrect DELETE Request");
		}
	break;
	case "EventInfo_2_Person" :
		if ($_SERVER['REQUEST_METHOD'] == "GET") {
		   if( (count($path_components) == 3) && $path_components[2] !== ""){
			$EventInfo_2_Person_id = intval($path_components[2]);
			$EventInfo_2_Person = EventInfo_2_Person::findByID($EventInfo_2_Person_id);

			if ($EventInfo_2_Person == null) {
     				header("HTTP/1.0 404 Not Found");
      				print("EventInfo_2_Person id: " . $EventInfo_2_Person_id . " not found.");
      				exit();
    			   }

			header('Content-Type: application/json');
			print($EventInfo_2_Person->getJSON());
			exit();

			}
		   else if (count($path_components) == 2){
			if (isset($_REQUEST['EventID'])) {
      			header("Content-type: application/json");
  				print(json_encode(EventInfo_2_Person::getIDs($_REQUEST['EventID'])));
  				exit();
    			}

			header("Content-type: application/json");
  			print(json_encode(EventInfo_2_Person::getAllIDs()));
  			exit();
		   }

		   header("HTTP/1.0 404 Bad Request");
		   print("Incorrect GET Request");
		}
		else if ($_SERVER['REQUEST_METHOD'] == "PUT"){
			if ((count($path_components) == 3) && ($path_components[2] !== "")){
				header("HTTP/1.0 404 Bad Request");
		   		print("Incorrect PUT Request");
  				exit();
		   	}

			$EventInfo_2_Person_id = intval($path_components[2]);
			$EventInfo_2_Person = EventInfo_2_Person::findByID($EventInfo_2_Person_id);

			if($EventInfo_2_Person == null){
				header("HTTP/1.0 404 Not Found");
      				print("EventInfo_2_Person id: " . $EventInfo_2_Person_id . " not found while attempting update.");
      				exit();
			}

			$new_eventID = false;
			$new_personID = false;

			if(isset($_REQUEST['EventID'])){
			  $new_eventID = $_REQUEST['EventID'];
			  if ($new_eventID <= 0) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad eventID");
				exit();
      			  }
			}

			if(isset($_REQUEST['PersonID'])){
			  $new_personID = trim($_REQUEST['PersonID']);
			  if ($new_personID <= 0) {
				header("HTTP/1.0 400 Bad Request");
				print("Bad personID");
				exit();
      			  }
			}


			if($new_eventID){
			  $EventInfo_2_Person->setEventID($new_eventID);
			}
			if($new_personID){
			  $EventInfo_2_Person->setPersonID($new_personID);
			}

    			header("Content-type: application/json");
    			print($EventInfo_2_Person->getJSON());
    			exit();

		}
		else if ($_SERVER['REQUEST_METHOD'] == "DELETE"){

		   	if(count($path_components) == 3){
			  $EventInfo_2_Person_id = intval($path_components[2]);
			  $EventInfo_2_Person = EventInfo_2_Person::findByID($EventInfo_2_Person_id);
			  $EventInfo_2_Person->delete();
			  header("Content-type: application/json");
      			  print(json_encode(true));
			  exit();
			}
			header("HTTP/1.0 404 Bad Request");
			print("Incorrect DELETE Request");
		}
	break;
	default:
	break;
}
header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");
