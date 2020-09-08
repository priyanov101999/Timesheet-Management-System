<!DOCTYPE html>
<html>
<head>
	<title>Client Details</title>
</head>
<body>
	
<?php
$task=$_GET["uid"];
$proj=$_GET["text2"];
echo "$task $proj";
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM assignment WHERE task='$task' && project_name='$proj'";

if ($conn->query($sql) === TRUE) {
   header("Location: taskshow.php?pname=".$proj);
} 
else {
    echo "Error updating record: ".$sql." ". $conn->error;
}

$conn->close();
?>

</body>
</html>
