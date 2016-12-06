<?php
date_default_timezone_set('America/New_York');

class MasterEventCheckIn
{
  private $fName;
  private $lName;
  private $email;
  private $eventName;

  public static function connect() {
    return new mysqli("classroom.cs.unc.edu", 
		      "kykyle", 
                      "Whaling11!!!", 
		      "kykyledb");
  }

  public static function insert($fName, $lName, $email, $eventName) {
    $mysqli = MasterEventCheckIn::connect();

    $result = $mysqli->query("insert into MasterEventCheckIn (fName, lName, email, eventName) values (" .
			     "'" . $mysqli->real_escape_string($fName) . "', " .
			     "'" . $mysqli->real_escape_string($lName) . "', " .
		      	     "'" . $mysqli->real_escape_string($email) . "', " .
			     "'" . $mysqli->real_escape_string($eventName) . "')");
    
    if ($result) {
      $id = $mysqli->insert_id;
      return new MasterEventCheckIn($fName, $lName, $email, $eventName);
    }
    return null;
  }

  private function __construct($fName, $lName, $email, $eventName) {
    $this->fName = $fName;
    $this->lName = $lName;
    $this->email = $email;
    $this->eventName = $eventName;
  }

  public function delete() {
    $mysqli = MasterEventCheckIn::connect();
    $mysqli->query("delete from MasterEventCheckIn where email = " . $this->email);
  }

  public function getJSON() {

    $json_obj = array('fName' => $this->fName,
		      'lName' => $this->lName,
		      'email' => $this->email,
		      'eventName' => $this->eventName);
    return json_encode($json_obj);
  }
}


