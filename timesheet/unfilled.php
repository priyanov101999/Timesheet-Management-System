<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="basic.css">
    
    <style>
      #content{
           


      }
      #entry{
      display: inline;
      width:200px;
      height: 50px;

      }
      input,select{
            width: 200px;
            height: 35px;
            border: none;
            outline: none;
        }
    </style>
<body bgcolor="#ffffff">

<center>
<?php

$today=date("Y-m-d");
$after7=date('Y-m-d',strtotime('-7 days'));
isset($_GET["start"])?$start=$_GET["start"]:$start=$after7;
isset($_GET["end"])?$end=$_GET["end"]:$end=$today;
echo "<div><b><fieldset style='height:50px;'><legend>UNFILLED TIMESHEETS</legend>";
echo "From:<input type='date' id='from' value='".$start."' onchange=\"dateselect()\"> To:<input type='date'  value='".$end."' id='to' onchange=\"dateselect()\">";
echo "</fieldset></b></div>";
getDatesFromRange($start,$end,'Y-m-d');
echo "<div id=\"content\">";

function getUnfilled($date){

      $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
      die("Server Connection failed:" . $conn->connect_error);
      }

      $sql ="SELECT username FROM employee_information";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

          $emp=$row['username'];

          $sql1="SELECT hour FROM $emp WHERE Date='$date'";
          $result1 = $conn->query($sql1);

          if ($result1->num_rows > 0) {
          while($row1 = $result1->fetch_assoc()) {
              if($row1["hour"]==0){
                  echo "<fieldset id=\"entry\"><legend>".$emp."</legend><input name='date[]' type='date' value='".$date."' readonly></fieldset>";   //hour is 0 //date exists but unfilled
              }
            }
        } else {
              echo "<fieldset id=\"entry\"><legend>".$emp."</legend><input name='date[]' type='date' value='".$date."' readonly></fieldset>"; //date does not exist
         }

       }

    } else {
    echo "no employees";
     }



}

function getDatesFromRange($start, $end,$format) {

    $array = array();
    $interval = new DateInterval('P1D');

    $realEnd = new DateTime($end);
    $realEnd->add($interval);

    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

    foreach($period as $date) { 
        $array[] = $date->format($format); 
    }

    $no=count($array);
     for($i=0;$i<$no; $i++){

         getUnfilled($array[$i]);//displays all unfilled dates for every employee 

     }
}
echo "</div>";
?>
<script type="text/javascript">

    function dateselect(){

    var start=document.getElementById("from").value;
    var end=document.getElementById("to").value;
    window.location.href="unfilled.php?start="+start+"&end="+end;

    }
</script>
</center>
</body>
</html>