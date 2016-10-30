 <?php
$servername = "aamcogidqmerwy.cbnbzucuzfue.us-east-1.rds.amazonaws.com";
$username = "tbrum96";
$password = "Hacknc2016!";
$dbname = "ebdb";

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$fName = $_GET['fName'];
	$email= $_GET['email'];
	$lName = $_GET['lName'];
	$eName = $_GET['eName'];
	$eDescription = $_GET['eDescription'];
	$latitude = NULL;
	$longitude = NULL;
	$startTime = NULL;
	$endTime = NULL;
	$numberAttending = 1;
	
	$sql = "INSERT INTO Person ( fName, lName, email) VALUES ('$fName', '$lName', '$email')";
	$sql2 = "INSERT INTO EventInfo (eventName, latitude, longitude, numberAttending, hostEmail, startTime, endTime, description) 
				VALUES ('$eName','$latitude','$longitude','$numberAttending','$email','$startTime','$endTime','$eDescription')";
    $conn->exec($sql);
	echo "New record created";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?> 