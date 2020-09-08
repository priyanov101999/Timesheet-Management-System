<!DOCTYPE html>
<!--processes add project-->

<html>
<head>
	<title></title>
</head>
<body>
<?php
$name=$_POST["pname"];
$client=$_POST["clientdropdown"];
$org=$_POST["orgdropdown"];
$email=$_POST["mail"];
$tel=$_POST["phone"];
$stat=$_POST["status"];
$sdate=$_POST["stadate"];
$tdate=$_POST["tardate"];
$est=$_POST["esth"];
$desc=$_POST["desc"];
$assn=$_POST["assn"];//assigned to employee
$task=$_POST["task"];//taskname
$frdate=$_POST["frodate"];
$todate=$_POST["todate"];//est date
$estimate=$_POST["estimate"];//estimate of each employee
$status=$_POST["stat"];//status of each employee
$length=count($todate);
echo $length;


$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}



$sql = "INSERT INTO project_info(name,client_name,org_name,mail,contact,status,start,end,est_hours,description) VALUES ('$name','$client','$org','$email','$tel','$stat','$sdate','$tdate','$est','$desc')";
if ($conn->query($sql) === TRUE) {
	
} else {
    echo "alert(Error in insertion)".$sql;

}


for($i=0;$i<$length;$i++){
	   $a=$assn[$i];
	   $b=$task[$i];//task name
	   $c=$todate[$i];//est date
	   $d=$estimate[$i];
	   $e=$frdate[$i];
	   $f=$status[$i];
	   $AddQuery ="INSERT INTO assignment(project_name,task,emp_name,estimated,from_date,to_date,status,duration
)VALUES('$name','$b','$a','$d','$e','$c','$f',0)";
	   if ($conn->query($AddQuery) === TRUE) {
	header("Location: projectshow.php?name=".$name);
    } else {
    echo "alert(Error in assign insertion)".$AddQuery;

    }

}


$conn->close();
?>


</body>
</html>
