<?php
date_default_timezone_set('America/New_York');

class EventInfo_2_Person
{
  private $id;
  private $eventID;
  private $personID;
  public static function connect() {
    return new mysqli("classroom.cs.unc.edu", 
		      "kykyle", 
                      "Whaling11!!!", 
		      "kykyledb");
  }

  
  public static function findByID($id) {
    $mysqli = EventInfo_2_Person::connect();

    $result = $mysqli->query("select * from EventInfo_2_Person where id = " . $id);
    if ($result) {
      if ($result->num_rows == 0) {
	return null;
      }

      $EventInfo_2_Person_info = $result->fetch_array();

      return new EventInfo_2_Person(intval($EventInfo_2_Person_info['id']),
		      $EventInfo_2_Person_info['eventID'],
		      $EventInfo_2_Person_info['personID']);
      }
    return null;
  }

  public static function getAllIDs() {
    $mysqli = EventInfo_2_Person::connect();

    $result = $mysqli->query("select id from EventInfo_2_Person");
    $id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	$id_array[] = intval($next_row['id']);
      }
    }
    return $id_array;
  }
  public static function getIDs($eventID){
	$mysqli = EventInfo_2_Person::connect();
	$result = $mysqli->query("select id from EventInfo_2_Person where eventID = " . $eventID);
	$id_array = array();

	if ($result) {
	  while($next_row = $result->fetch_array()) {
	    $id_array[] = ($next_row['id']);
	  }
	}
	return $id_array;
  }

  private function __construct($id, $eventID, $personID) {
    $this->id = $id;
    $this->eventID = $eventID;
    $this->personID = $personID;
  }

  public function getID() {
    return $this->id;
  }

  public function getEventID() {
    return $this->eventID;
  }

  public function getPersonID() {
    return $this->personID;
  }

  public function setEventID($eventID) {
    $this->eventID = $eventID;
    return $this->update();
  }

  public function setPersonID($personID) {
    $this->personID = $personID;
    return $this->update();
  }

  private function update() {
    $mysqli = EventInfo_2_Person::connect();

    $result = $mysqli->query("update EventInfo_2_Person set " .
			     "eventID=" .
			     "'" . $mysqli->real_escape_string($this->eventID) . "', " .
			     "personID=" .
			     "'" . $mysqli->real_escape_string($this->personID) . "', " .
			     " where id=" . $this->id);
    return $result;
  }

  public function delete() {
    $mysqli = EventInfo_2_Person::connect();
    $mysqli->query("delete from EventInfo_2_Person where id = " . $this->id);
  }

  public function getJSON() {

    $json_obj = array('id' => $this->id,
		      'eventID' => $this->eventID,
		      'personID' => $this->personID);
    return json_encode($json_obj);
  }
}


