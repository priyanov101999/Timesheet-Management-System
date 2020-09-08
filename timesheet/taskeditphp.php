<!DOCTYPE html>
<!-- processes task edit  -->
<html>
<head>
	<title>Client Details</title>
</head>
<body>
	
<?php
$project=$_POST["projname"];
$task=$_POST["task"];
$duration=$_POST["duration"];
$estimate=$_POST["estimate"];
$from=$_POST["from"];
$to=$_POST["to"];
$stat=$_POST["status"];
$emp=$_POST["emp"];
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE assignment SET duration='$duration',estimated='$estimate' ,from_date='$from', to_date='$to' , status='$stat',emp_name='$emp' WHERE task='$task' && project_name='$project'";

if ($conn->query($sql) === TRUE) {
	header("Location: taskshow.php?pname=".$project);
} 
else {
    echo "Error updating record: ".$sql." ". $conn->error;
}

$conn->close();
?>


</body>
</html>
