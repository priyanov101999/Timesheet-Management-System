<!DOCTYPE html>
<!--add employee processing-->

<html>
<head>
	<title></title>
</head>
<body>
<?php
$uname=$_POST["username"];
$pswd=$_POST["pswd"];
$name=$_POST["name"];
$phno=$_POST["phno"];
$email=$_POST["email"];
$role=$_POST["role"];
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO employee_information(username,password,name,telephone,email,role) VALUES ('$uname','$pswd','$name','$phno','$email','$role')";
$create="CREATE TABLE $uname(Date date,project varchar(100),task varchar(100),hour int,description varchar(100))";
$pkey="ALTER TABLE $uname ADD PRIMARY KEY( Date, project,task);";
if ($conn->query($sql) === TRUE && $conn->query($create) === TRUE && $conn->query($pkey) === TRUE) {
    header("Location: empshow.php");
} else {
    echo "Error: " . $sql . "<br>".$create ."<br>". $conn->error;
}
$conn->close();
?>
</body>
</html>