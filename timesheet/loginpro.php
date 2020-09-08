<!DOCTYPE html>
<!-- login page gest username and password and feeds it to loginpro.php 
which validates and directs to either frontpage.php if role= manager and
timesheetshow.php if role = employee -->
<html>
<head>
	<title></title>
</head>
<body>
<?php
$username=$_POST["username"];
$password=$_POST["pswd"];
$conn = new mysqli("localhost","root","","timesheet"); //establish connection
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}

$sql = "SELECT role FROM employee_information WHERE username='$username' && password='$password'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($row["role"])) {


	if($row["role"]=="Administrator"){
	header("Location:frontpage.php?pname=".$username);
    }else{
    	header("Location:timesheetshow.php?pname=".$username);
    }

} else {
    header("Location:login.php?err=1");
}
$conn->close();


?>
</body>
</html>