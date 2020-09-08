<!DOCTYPE html>
<!-- processes client addition  -->
<html>
<head>
	<title></title>
</head>
<body>
<?php
$name=$_POST["name"];
$org=$_POST["orgname"];
$tel=$_POST["phno"];
$addr=$_POST["address"];
$stat=$_POST["status"];

$conn = new mysqli("localhost","root","","timesheet");//establish connection
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO client_information(client_name,org_name,telephone,address,status) VALUES ('$name','$org','$tel','$addr','$stat')";

if ($conn->query($sql) === TRUE) {
	header("Location: clientshow.php");
} else {
    echo "<script>";
    echo "alert(Error in insertion);";
    echo "</script>";
}
$conn->close();
?>


</body>
</html>










