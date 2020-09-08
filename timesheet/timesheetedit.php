<!DOCTYPE html>
<!-- editing in timesheet entries to database  -->
<html>
<head>
	<title>timesheet</title>
</head>
<body>
	
<?php
$name=$_GET["pname"];
$Date=$_POST["Date"];
$project=$_POST["project"];
$task=$_POST["task"];
$hour=$_POST["hour"];
$description=$_POST["description"];
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE $name SET hour='$hour',description='$description' WHERE Date='$Date' && project='$project' && task='$task'";

if ($conn->query($sql) === TRUE) {


       $DurationQuery="SELECT SUM(hour) AS dur FROM $name WHERE project='$project' && task='$task'";
       $result = $conn->query($DurationQuery);
       if ($result->num_rows > 0) {
       	 while($row = $result->fetch_assoc()){
       	 	$dur=$row["dur"];
  
       	 	$durupdate="UPDATE assignment SET duration='$dur' WHERE project_name='$project' && task='$task'";
       	 	$conn->query($durupdate);
       	 }

       }else {
       echo "0 results".$sql."<br>";//self testing
     }


    header("Location: timesheetshow.php?pname=$name");
} 
else {
    echo "Error updating record: ".$sql." ". $conn->error;
}

$conn->close();
?>


</body>
</html>
