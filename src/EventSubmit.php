 <?php
 //v0.0
$servername = "aamcogidqmerwy.cbnbzucuzfue.us-east-1.rds.amazonaws.com";
$username = "tbrum96";
$password = "Hacknc2016!";
$dbname = "ebdb";

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$fName = $_POST['fName'];
	$email= $_POST['email'];
	$lName = $_POST['lName'];
	$eName = $_POST['eName'];
	$eDescription = $_POST['eDescription'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$startTime = $_POST['sTime'];
	$endTime = $_POST['eTime'];
	$numberAttending = 0;
	
	$sql = "INSERT INTO Person ( fName, lName, email) VALUES ('$fName', '$lName', '$email')";
	$sql2 = "INSERT INTO EventInfo (eventName, latitude, longitude, numberAttending, hostEmail, startTime, endTime, description) 
				VALUES ('$eName','$latitude','$longitude','$numberAttending','$email','$startTime','$endTime','$eDescription')";
    $sql3 = "INSERT INTO EventInfo_2_Person (eventId, personId) VALUES ('$eName', '$email')";
	$conn->exec($sql);
	$conn->exec($sql2);
	$conn->exec($sql3);
	echo "Added $eName,$latitude,$longitude,$numberAttending,$email,$startTime,$endTime,$eDescription";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?> 