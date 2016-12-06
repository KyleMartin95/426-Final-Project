 <?php

  require_once('eventORM.php');

  print_r($_POST);
  print_r($_GET);
  print_r($_REQUEST);

  $path_components = explode('/', $_SERVER['PATH_INFO']);
// test too see if post was made/////////////
  if($_SERVER['REQUEST_METHOD']=='POST'){
    echo "got post request";
  }else{
    echo "did not get post";
    print_r($_SERVER['REQUEST_METHOD']);
  }
  //////test and assign each parameter
  if(isset($_REQUEST['firstName'])){
    $fName = $_REQUEST['firstName'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing first name");
    exit();
  }

  if(isset($_REQUEST['lastName'])){
    $lName = $_REQUEST['lastName'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing last name");
    exit();
  }

  if(isset($_REQUEST['email'])){
    $email = $_REQUEST['email'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing email");
    exit();
  }

  if(isset($_REQUEST['eventName'])){
    $eName = $_REQUEST['eventName'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing event name");
    exit();
  }

  if(isset($_REQUEST['eventDescription'])){
    $eDescription = $_REQUEST['eventDescription'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing event description");
    exit();
  }

  if(isset($_REQUEST['latitude'])){
    $latitude = $_REQUEST['latitude'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing latitude");
    exit();
  }

  if(isset($_REQUEST['longitude'])){
    $longitude = $_REQUEST['longitude'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing longitude");
    exit();
  }

  if(isset($_REQUEST['startTime'])){
    $sTime = $_REQUEST['startTime'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing start time");
    exit();
  }

  if(isset($_REQUEST['endTime'])){
    $eTime = $_REQUEST['endTime'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing endTime");
    exit();
  }

  if(isset($_REQUEST['radius'])){
    $radius = $_REQUEST['radius'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing radius");
    exit();
  }
  $numberAttending = 0;

  
///////////////////insert info into database////////////////////////////
  $new_event = MasterEventCreate::insert($fName, $lName, $email, $eName, $latitude, $longitude, $radius, $numberAttending, $sTime, $eTime, $eDescription);

  // Report if failed
  if ($new_event == null) {
    header("HTTP/1.0 500 Server Error");
    print("Server couldn't create new event");
    exit();
  }

  //Generate JSON encoding of new event
  header("Content-type: application/json");
  print($new_event->getJSON());
  exit();

?>
