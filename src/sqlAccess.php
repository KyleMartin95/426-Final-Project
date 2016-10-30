 <?php
$servername = "checkinc-db-cluster-1.cluster-c0wgf46nqjeq.us-west-2.rds.amazonaws.com";
$username = "tbrum96";
$password = "Hacknc2016!";
$dbname = "CheckiNC";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO Person ( fName, lName, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fName, $lName, $email);

// set parameters and execute
$fName = $_POST['fName'];
$email= $_POST['email'];
$eDescription = $_POST['lName']
$stmt->execute();

echo "New person record has been created successfully";

$stmt->close();

// prepare and bind
$stmt = $conn->prepare("INSERT INTO EventInfo ( eventName, hostEmail, description) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $eName, $email, $eDescription);

// set parameters and execute
$eName = $_POST['eName'];
$email= $_POST['email'];
$eDescription = $_POST['eDescription']
$stmt->execute();

echo "New event record has been created successfully";

$stmt->close();
$conn->close();
?> 