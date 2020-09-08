<!DOCTYPE html>
<!--add timesheet entries to database-->

<html>
<head>
    <title></title>
</head>
<body>
<?php
$name=$_GET["uname"];
$date=$_POST["date"];
$project=$_POST["project"];
$task=$_POST["task"];
$hours=$_POST["hours"];
$desc=$_POST["desc"];
$length=count($date);
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}

for($i=0;$i<$length;$i++){
       $a=$date[$i];
       $b=$project[$i];
       $c=$task[$i];
       $d=$hours[$i];
       $e=$desc[$i];
       $dur=0;
      


       $sql="SELECT project,task FROM $name WHERE project!='---' && task!='---' && Date='$a'";
       //checks if the current record has full data
       $result = $conn->query($sql);
       if ($result->num_rows == 0 ||( $b!='---' && $c!='---')) { //no full data in current record || full data but the new data is also full
        

       $deleteQuery="DELETE FROM $name WHERE project='---' && task='---' && Date='$a'"; //deletes the current record if its empty to make way for new full/another empty  record
       // removes possibility of 2 empty or 1empty/1full record
       $conn->query($deleteQuery);

       //updates duration
       $DurationQuery="SELECT SUM(hour) FROM $name WHERE project='$b' && task='$c'";
       $result = $conn->query($DurationQuery);
       if ($result->num_rows > 0) {
       	 while($row = $result->fetch_assoc()){
       	 	$dur=$row["SUM(hour)"];
  
       	 	$durupdate="UPDATE assignment SET duration='$dur' WHERE project_name='$b' && task='$c'";
       	 	$conn->query($durupdate);
       	 }

       }else {
       echo "0 results".$sql."<br>";//self testing
     }
       

        $AddQuery ="INSERT INTO $name(Date,project,task,hour,description)VALUES('$a','$b','$c','$d','$e')";

        //inserts data
       if ($conn->query($AddQuery) === TRUE)
        {
       header("Location: timesheetshow.php?pname=".$name);
       } else {

         echo "<script>alert(\"already entered \");</script>";
          header("Location: timesheetshow.php?pname=".$name);

    }
   }else {
       header("Location: timesheetshow.php?pname=".$name);


    }
       	 

       }
$conn->close();
?>
</body>
</html>
