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

    $result = $mysqli->query("select * from EventInfo_2_Person where ID = " . $id);
    if ($result) {
      if ($result->num_rows == 0) {
	return null;
      }

      $EventInfo_2_Person_info = $result->fetch_array();

      return new EventInfo_2_Person(intval($EventInfo_2_Person_info['ID']),
		      $EventInfo_2_Person_info['eventId'],
		      $EventInfo_2_Person_info['personId']);
      }
    return null;
  }

  public static function getAllIDs() {
    $mysqli = EventInfo_2_Person::connect();

    $result = $mysqli->query("select ID from EventInfo_2_Person");
    $id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	$id_array[] = intval($next_row['ID']);
      }
    }
    return $id_array;
  }
  public static function getIDs($eventID){
	$mysqli = EventInfo_2_Person::connect();
	$result = $mysqli->query("select ID from EventInfo_2_Person where eventId = " . $eventID);
	$id_array = array();

	if ($result) {
	  while($next_row = $result->fetch_array()) {
	    $id_array[] = ($next_row['ID']);
	  }
	}
	return $id_array;
  }

  private function __construct($id, $eventID, $personID) {
    $this->ID = $id;
    $this->eventId = $eventID;
    $this->personId = $personID;
  }

  public function getID() {
    return $this->ID;
  }

  public function getEventId() {
    return $this->eventId;
  }

  public function getPersonId() {
    return $this->personId;
  }

  public function setEventId($eventID) {
    $this->eventId = $eventID;
    return $this->update();
  }

  public function setPersonId($personID) {
    $this->personId = $personID;
    return $this->update();
  }

  private function update() {
    $mysqli = EventInfo_2_Person::connect();

    $result = $mysqli->query("update EventInfo_2_Person set eventId = " . $this->eventID . 
				 ", personId = " . $this->personID . 
				 ", where ID = " . $this->id);
    return $result;
  }

  public function delete() {
    $mysqli = EventInfo_2_Person::connect();
    $mysqli->query("delete from EventInfo_2_Person where ID = " . $this->id);
  }

  public function getJSON() {

    $json_obj = array('ID' => $this->id,
		      'eventId' => $this->eventID,
		      'personId' => $this->personID);
    return json_encode($json_obj);
  }
}


