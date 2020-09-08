<!DOCTYPE html>
<html>
<head>
	<title>Client Details</title>
</head>
<body>
	
<?php
$uname=$_POST["uname"];
$name=$_POST["name"];
$tel=$_POST["contact"];
$email=$_POST["email"];
$role=$_POST["role"];
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE employee_information SET name='$name' ,telephone ='$tel' ,email='$email' ,role='$role' WHERE username='$uname' ";

if ($conn->query($sql) === TRUE) {
    header("Location: empshow.php");
} 
else {
    echo "Error updating record: ".$sql." ". $conn->error;
}

$conn->close();
?>


</body>
</html>
