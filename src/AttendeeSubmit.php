 <?php
$servername = "aamcogidqmerwy.cbnbzucuzfue.us-east-1.rds.amazonaws.com";
$username = "tbrum96";
$password = "Hacknc2016!";
$dbname = "ebdb";

///////////////TODO: Eliminate duplicates in eventInfo_2_person////////////////////////
///////////////dont allow registration if past event expiration///////////////////////

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$fName = $_GET['fName'];
	$email= $_GET['email'];
	$lName = $_GET['lName'];
	$eName = $_GET['eName'];
	
	$sql = "INSERT INTO Person ( fName, lName, email) VALUES ('$fName', '$lName', '$email')";
    $conn->exec($sql);
	$sql2 = "INSERT INTO EventInfo_2_Person (eventId, personId) VALUES ('$eName', '$email')";
	$conn->exec($sql2);
	$sql3 = "UPDATE EventInfo SET numberAttending = numberAttending + 1 WHERE EventInfo.eventName = '$eName'";
	$conn->exec($sql3);
	echo "New record created";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?> 