<?php
date_default_timezone_set('America/New_York');

class EventInfo
{
  private $id;
  private $eventName;
  private $longitude;
  private $latitude;
  private $radius;
  private $numberAttending;
  private $hostID;
  private $startTime;
  private $endTime;
  private $description;

  public static function connect() {
    return new mysqli("classroom.cs.unc.edu",
		      "kykyle",
                      "Whaling11!!!",
		      "kykyledb");
  }

  public static function insert($eventName, $latitude, $longitude, $radius, $numberAttending, $hostID, $startTime, $endTime, $description) {
    $mysqli = EventInfo::connect();

    if ($startTime == null) {
      $strt = "null";
    } else {
      $strt = "'" . $startTime->format('Y-m-d h:i:s') . "'";
    }

    if ($endTime == null) {
      $endt = "null";
    } else {
      $endt = "'" . $endTime->format('Y-m-d h:i:s') . "'";
    }

    $result = $mysqli->query("insert into EventInfo values (0, " .
			     "'" . $mysqli->real_escape_string($eventName) . "', " .
			     $latitude . ", " .
			     $longitude . ", " .
			     $radius . ", " .
			     $numberAttending . ", " .
			     $hostID . ", " .
			     $strt . ", " .
			     $endt . ", " .
			     "'" . $mysqli->real_escape_string($description) . "')");

    if ($result) {
      $id = $mysqli->insert_id;
      return new EventInfo($id, $eventName, $latitude, $longitude, $radius, $numberAttending, $hostID, $startTime, $endTime, $description);
    }
    return null;
  }

  public static function getAllIDs() {
    $mysqli = EventInfo::connect();

    $result = $mysqli->query("select id from EventInfo");
    $id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	$id_array[] = intval($next_row['id']);
      }
    }
    return $id_array;
  }

  public static function findByEventName($eventName){
    $mysqli = EventInfo::connect();

    $result = $mysqli->query("select * from EventInfo where eventName = " . $eventName);
    if ($result) {
      if ($result->num_rows == 0) {
	return null;
      }

      $EventInfo_info = $result->fetch_array();

      if ($EventInfo_info['startTime'] != null) {
	$startTime = new DateTime($EventInfo_info['startTime']);
      } else {
	$startTime = null;
      }

      if ($EventInfo_info['endTime'] != null) {
	$endTime = new DateTime($EventInfo_info['endTime']);
      } else {
	$endTime = null;
      }

      return new EventInfo(intval($EventInfo_info['id']),
		      $EventInfo_info['eventName'],
		      floatval($EventInfo_info['latitude']),
		      floatval($EventInfo_info['longitude']),
		      floatval($EventInfo_info['radius']),
		      intval($EventInfo_info['numberAttending']),
		      intval($EventInfo_info['hostID']),
		      $startTime,
		      $endTime,
		      $EventInfo_info['description']);
    }
    return null;
  }

  private function __construct($id, $eventName, $latitude, $longitude, $radius, $numberAttending, $hostID, $startTime, $endTime, $description) {
    $this->id = $id;
    $this->eventName = $eventName;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->radius = $radius;
    $this->numberAttending = $numberAttending;
    $this->hostID = $hostID;
    $this->startTime = $startTime;
    $this->endTime = $endTime;
    $this->description = $description;
  }

  public function getID() {
    return $this->id;
  }

  public function getEventName() {
    return $this->eventName;
  }

  public function getLatitude() {
    return $this->latitude;
  }

  public function getLongitude() {
    return $this->longitude;
  }

  public function getRadius() {
    return $this->radius;
  }

  public function getNumberAttending() {
    return $this->numberAttending;
  }

  public function getStartTime() {
    return $this->startTime;
  }

  public function getEndTime() {
    return $this->endTime;
  }

  public function getDescription(){
    return $this->description;
  }

  public function setEventName($eventName) {
    $this->eventName = $eventName;
    return $this->update();
  }

  public function setLatitude($latitude) {
    $this->latitude = $latitude;
    return $this->update();
  }

  public function setLongitude($longitude) {
    $this->longitude = $longitude;
    return $this->update();
  }

  public function setRadius($radius) {
    $this->radius = $radius;
    return $this->update();
  }

  public function setNumberAttending($numberAttending) {
    $this->numberAttending = $numberAttending;
    return $this->update();
  }

  public function setHostID($hostID) {
    $this->hostID = $hostID;
    return $this->update();
  }

  public function setStartTime($startTime) {
    $this->startTime = $startTime;
    return $this->update();
  }

  public function setEndTime($endTime) {
    $this->endTime = $endTime;
    return $this->update();
  }

  public function description($description){
    $this->description = $description;
    return $this->update();
  }

  private function update() {
    $mysqli = EventInfo::connect();

    if ($this->startTime == null) {
      $strt = "null";
    } else {
      $strt = "'" . $this->startTime->format('Y-m-d h:i:s') . "'";
    }

    if ($this->endTime == null) {
      $endt = "null";
    } else {
      $endt = "'" . $this->endtime->format('Y-m-d h:i:s') . "'";

    $result = $mysqli->query("update EventInfo set " .
			     "eventName=" .
			     "'" . $mysqli->real_escape_string($this->eventName) . "', " .
			     "latitude=" .
			     $this->latitude . ", " .
			     "longitude=" .
			     $this->longitude . ", " .
			     "radius=" .
			     $this->radius . ", " .
			     "numberAttending=" .
			     $this->numberAttending . ", " .
			     "hostID=" .
			     $this->hostID . ", " .
			     "startTime=" . $strt . ", " .
			     "endTime=" . $endt . ", " .
			     "description=" .
			     "'" . $mysqli->real_escape_string($this->description) . "'" .
			     " where id=" . $this->id);
    return $result;
  }
}

  public function delete() {
    $mysqli = EventInfo::connect();
    $mysqli->query("delete from EventInfo where id = " . $this->id);
  }

  public function getJSON() {
    if ($this-> startTime == null) {
      $strt = null;
    } else {
      $strt= $this->startTime->format('Y-m-d h:i:s');
    }

    if ($this-> endTime == null) {
      $endt = null;
    } else {
      $endt= $this->endTime->format('Y-m-d h:i:s');
    }


    $json_obj = array('id' => $this->id,
		      'eventName' => $this->eventName,
		      'latitude' => $this->latitude,
		      'longitude' => $this->longitude,
		      'radius' => $this->radius,
		      'numberAttending' => $this->numberAttending,
		      'hostID' => $this->hostID,
		      'startTime' => $strt,
		      'endTime' => $endt,
		      'description' => $this->description);
    return json_encode($json_obj);
  }
}

