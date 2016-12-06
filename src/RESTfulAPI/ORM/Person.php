<?php
date_default_timezone_set('America/New_York');

class Person
{
  private $id;
  private $fName;
  private $lName;
  private $email;

  public static function connect() {
    return new mysqli("classroom.cs.unc.edu", 
		      "kykyle", 
                      "Whaling11!!!", 
		      "kykyledb");
  }

  public static function insert($fName, $lName, $email) {
    $mysqli = Person::connect();

    $result = $mysqli->query("insert into Person (fName, lName, email) values (" .
			     "'" . $mysqli->real_escape_string($fName) . "', " .
			     "'" . $mysqli->real_escape_string($lName) . "', " .
			     "'" . $mysqli->real_escape_string($email) . "')");
    
    if ($result) {
      $id = $mysqli->insert_id;
      return new Person($id, $fName, $lName, $email);
    }
    return null;
  }

  public static function findByID($id) {
    $mysqli = Person::connect();

    $result = $mysqli->query("select * from Person where ID = " . $id);
    if ($result) {
      if ($result->num_rows == 0) {
	return null;
      }

      $Person_info = $result->fetch_array();

      return new Person(intval($Person_info['ID']),
		      $Person_info['fName'],
		      $Person_info['lName'],
		      $Person_info['email']);
    }
    return null;
  }

  public static function getAllIDs() {
    $mysqli = Person::connect();

    $result = $mysqli->query("select ID from Person");
    $id_array = array();

    if ($result) {
      while ($next_row = $result->fetch_array()) {
	$id_array[] = intval($next_row['ID']);
      }
    }
    return $id_array;
  }
  public static function getIDs($email){
	$mysqli = Person::connect();
	$result = $mysqli->query("select ID from Person where email = " . $email);
	$id_array = array();

	if ($result) {
	  while($next_row = $result->fetch_array()) {
	    $id_array[] = ($next_row['ID']);
	  }
	}
	return $id_array;

  }

  private function __construct($id, $fName, $lName, $email) {
    $this->ID = $id;
    $this->fName = $fName;
    $this->lName = $lName;
    $this->email = $email;
  }

  public function getID() {
    return $this->ID;
  }

  public function getFName() {
    return $this->fName;
  }

  public function getLName() {
    return $this->lName;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setFName($fName) {
    $this->fName = $fName;
    return $this->update();
  }

  public function setLName($lName) {
    $this->lName = $lName;
    return $this->update();
  }

  public function setEmail($email) {
    $this->email = $email;
    return $this->update();
  }

  private function update() {
    $mysqli = Person::connect();

    $result = $mysqli->query("update Person set " .
			     "fName=" .
			     "'" . $mysqli->real_escape_string($this->fName) . "', " .
			     "lName=" .
			     "'" . $mysqli->real_escape_string($this->lName) . "', " .
			     "email=" .
			     "'" . $mysqli->real_escape_string($this->email) . "', " .
			     " where ID=" . $this->ID);
    return $result;
  }

  public function delete() {
    $mysqli = Person::connect();
    $mysqli->query("delete from Person where ID = " . $this->ID);
  }

  public function getJSON() {

    $json_obj = array('ID' => $this->ID,
		      'fName' => $this->fName,
		      'lName' => $this->lName,
		      'email' => $this->email);
    return json_encode($json_obj);
  }
}

?>