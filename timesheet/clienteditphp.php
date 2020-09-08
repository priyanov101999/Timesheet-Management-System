<!DOCTYPE html>
<!-- processes client edit  -->
<html>
<head>
	<title>Client Details</title>
</head>
<body>
	
<?php
$name=$_POST["name"];
$org=$_POST["oname"];
$tel=$_POST["contact"];
$addr=$_POST["address"];
$stat=$_POST["status"];
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE client_information SET org_name='$org', telephone='$tel' ,address='$addr' , status='$stat' WHERE client_name='$name'";

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
