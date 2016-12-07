<?php
date_default_timezone_set('America/New_York');

class MasterEventCreate
{
  private $fName;
  private $lName;
  private $email;
  private $eventName;
  private $latitude;
  private $longitude;
  private $radius;
  private $numberAttending;
  private $startTime;
  private $endTime;
  private $description;

  public static function connect() {
    echo " made it to connect method ";
    return new mysqli("classroom.cs.unc.edu","kykyle","Whaling11!!!", "kykyledb");
  }

  public static function insert($fName, $lName, $email, $eventName, $latitude, $longitude, $radius, $numberAttending, $startTime, $endTime, $description) {
    $mysqli = MasterEventCreate::connect();
    echo " made it to insert method ";

/*
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

*/
    $strt = "";
    $endt = "";

    $queryText = "insert into MasterEventCreate (fName, lName, email, eventName, latitude, longitude, radius, numberAttending, description) values ('" .
          $mysqli->real_escape_string($fName) . "', '" .
          $mysqli->real_escape_string($lName) . "', '" .
          $mysqli->real_escape_string($email) . "', '" .
          $mysqli->real_escape_string($eventName) . "', " .
			     $latitude . ", " .
			     $longitude . ", " .
			     $radius . ", ".
			     $numberAttending . ", ".
			     $strt . ", " .
			     $endt . ", " .
			     "'" . $mysqli->real_escape_string($description) . "')";

       echo $queryText;

    $result = $mysqli->query("insert into MasterEventCreate (fName, lName, email, eventName, latitude, longitude, radius, numberAttending, description) values ('" .
          $mysqli->real_escape_string($fName) . "', '" .
          $mysqli->real_escape_string($lName) . "', '" .
          $mysqli->real_escape_string($email) . "', '" .
          $mysqli->real_escape_string($eventName) . "', " .
			     $latitude . ", " .
			     $longitude . ", " .
			     $radius . ", ".
			     $numberAttending . ", ".
			     //$strt . ", " .
			     //$endt . ", " .
			     "'" . $mysqli->real_escape_string($description) . "')");

    echo $result;

    if ($result) {
      $id = $mysqli->insert_id;
      return new MasterEventCreate($fName, $lName, $email, $eventName, $latitude, $longitude, $radius, $numberAttending, $startTime, $endTime, $description);
    }
    return null;
  }

  private function __construct($fName, $lName, $email, $eventName, $latitude, $longitude, $radius, $numberAttending, $startTime, $endTime, $description) {
    echo "made it to constructor";
    $this->fName = $fName;
    $this->lName = $lName;
    $this->email = $email;
    $this->eventName = $eventName;
    $this->latitude = $latitude;
    $this->longitude = $longitude;
    $this->radius = $radius;
    $this->numberAttending = $numberAttending;
    $this->startTime = $startTime;
    $this->endTime= $endTime;
    $this->description = $description;
  }

  public function delete() {
    $mysqli = MasterEventCreate::connect();
    $mysqli->query("delete from MasterEventCreate where eventName = " . $this->eventName);
  }

  public function getJSON() {

/*
     if ($startTime == null) {
      $strt = null;
    } else {
      $strt = $this->startTime->format('Y-m-d h:i:s');
    }

    if ($endTime == null) {
      $endt = null;
    } else {
      $endt = $this->endTime->format('Y-m-d h:i:s');
    }
*/
    $strt = null;
    $endt = null;

    $json_obj = array('fName' => $this->fName,
		      'lName' => $this->lName,
		      'email' => $this->email,
		      'eventName' => $this->eventName,
		      'latitude' => $latitude,
		      'longitude' => $this->longitude,
		      'radius' => $this->radius,
		      'numberAttending' => $this->numberAttending,
		      'startTime' => $strt,
		      'endTime' => $endt,
		      'description' => $this->description);
    return json_encode($json_obj);
  }
}
