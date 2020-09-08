<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<?php
$name=$_POST["proname"];
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
    header("Location: taskshow.php?pname=".$name);
    } else {
    echo "alert(Error in assign insertion)".$AddQuery;

    }

}
$conn->close();
?>
</body>
</html>
