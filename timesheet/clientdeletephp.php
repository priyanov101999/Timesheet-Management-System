<!DOCTYPE html>
<!--DELETES SPECIFIED CLIENT -->
<html>
<head>
	<title>Client Details</title>
</head>
<body>
	
<?php
$name=$_GET["uid"];
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM client_information WHERE client_name='$name'";

if ($conn->query($sql) === TRUE) {
    header("Location: clientshow.php");
} 
else {
    echo "Error updating record: ".$sql." ". $conn->error;
}

$conn->close();
?>


</body>
</html>
