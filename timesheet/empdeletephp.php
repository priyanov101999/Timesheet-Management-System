<!DOCTYPE html>
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
$sql = "DELETE FROM employee_information WHERE username='$name'";
$del="DROP TABLE $name";
if ($conn->query($sql) === TRUE && $conn->query($del) === TRUE) {
    header("Location: empshow.php");
} 
else {
    echo "Error updating record: ".$sql." ". $conn->error;
}

$conn->close();
?>


</body>
</html>