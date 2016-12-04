<?php

  require_once('attendeeORM.php');

  $path_components = explode('/', $_SERVER['PATH_INFO']);

  if(isset($_REQUEST['eventName'])){
    $aEName = $_REQUEST['eventName'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing event name");
    exit();
  }

  if(isset($_REQUEST['firstName'])){
    $aFName = $_REQUEST['firstName'];
  }else{
    header("HTTP/1.0 400 Bad Request");
    print("Missing first name");
    exit();
  }

  if(isset($_REQUEST['lastName'])){
    $aLName = $_REQUEST['lastName'];
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

  $newAttendee = attendeeORM::insert($aEName, $aFName, $aLName, $email);

?>
