 <?php
$servername = "checkinc-db-cluster-1.cluster-c0wgf46nqjeq.us-west-2.rds.amazonaws.com:3306";
$username = "tbrum96";
$password = "Hacknc2016!";
$dbname = "CheckiNC";

// Create connection
try {
    $conn = new PDO("mysql:host=$servername;dbname=$CheckiNC", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$fName = $_GET['fName'];
	$email= $_GET['email'];
	$lname = $_GET['lName'];
	$sql = "INSERT INTO Person ( fName, lName, email) VALUES ('$fName', '$lName', $'email')";
    $conn->exec($sql);
	echo "New record created";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
$conn = null;
?> 