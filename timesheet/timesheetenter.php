<!DOCTYPE html>
<!--allows users to enter the new timesheet data submit button leads to timesheetadd.php-->
<html>
<head>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="basic.css">
    <title>Current week timesheet</title>
    <style type="text/css">
     a,.heading {
        align-content: left;
        display: inline;

        margin: 10px;
  
     }
     a{
        align-content: left;
        display: inline;
        text-decoration: none;
        color: #7CCF17;
        font-size: 25px;
        margin: 10px;
  
     }
     input,select{
            width: 150px;
            background-color: #f7f7f7;
            height: 35px;
            text-align: center;
            border: none;
            outline: none;
            margin-left: 10px;
     }
     
     .content{
            width: 200px;
            background-color: #ffffff;
            height: 30px;
            border: 1px solid lightgrey;
            outline: none;
            margin-left: 10px;
        }
        th{
          background-color: #f7f7f7;
        }

     
    </style>
</head>
<body bgcolor="#f7f7f7">
<?php

isset($_GET["pname"])?$name=$_GET["pname"]:$name="No Name";
echo "<div id='header'><a href=\"timesheetshow.php?pname=$name\"><i class=\" far fa-arrow-alt-circle-left
\"></i></a><div class='heading'><button ><i class=\"fas fa-user-circle\"></i></button>  Employee: <input type='text' id='uname' class='heading' value='".$name."' readonly></div>";
$today=date("Y-m-d");
$after7=date('Y-m-d',strtotime('-7 days'));
isset($_GET["start"])?$start=$_GET["start"]:$start=$after7;
isset($_GET["end"])?$end=$_GET["end"]:$end=$today;

echo "<div class='heading'><button ><i class=\"far fa-calendar-alt\"></i></button>From:<input type='date' class='".$name."' id='from' value='".$start."' onchange=\"dateselect(this.className)\" ></div><div class='heading'><button ><i class=\"far fa-calendar-alt\"></i></button> To:<input type='date'  value='".$end."' class='".$name."' id='to' onchange=\"dateselect(this.className)\"></div>";

echo "<a href=\"login.php\" style='float : right;'><i class=\"fas fa-power-off\"></i></a>";
echo "</div><br>";
//submit button leads to timesheetadd.php
echo "<form action='timesheetadd.php?uname=".$name."' method='POST'><input type='submit' value='submit' id='myBtn' style='float: right;'><br><center><table><tr><th></th><th>Date</th><th>Project</th><th>Task</th><th>Hours Spent</th><th>Description</th></tr>";
getDatesFromRange($start,$end,'Y-m-d',$name);

function createProject($uname){ //shows current projects of the employee in the dropdown list
      $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
      die("Server Connection failed: " . $conn->connect_error);
      }
      $sql ="SELECT name FROM project_info";
      $result = $conn->query($sql);
     if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
            echo "<option>".$row['name']."</option>";
       }
    } else {
    echo "0 results";
     }
}
function createTask($uname){ //shows current tasks ofchosen project of the employee in the dropdown list
      $conn = new mysqli("localhost","root","","timesheet");
      if ($conn->connect_error) {
      die("Server Connection failed: " . $conn->connect_error);
      }
      $sql ="SELECT task FROM assignment WHERE emp_name IN (SELECT name FROM employee_information WHERE username='$uname')";
      $result = $conn->query($sql);
     if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
            echo "<option>".$row['task']."</option>";
       }
    } else {
    echo "0 results";
     }


}

function getDatesFromRange($start, $end,$format,$uname) { //displying the form for relevant dates

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

     echo "<tr><td><button><i class=\"far fa-calendar\"></i></button></td><td><input class='content' name='date[]' type='date' style='border: none;' value='".$array[$i]."' readonly></td><td><select class='content' name='project[]'><option>---</option>";
      createProject($uname);
     echo "</select></td>";

     echo "<td><select class='content' name='task[]'><option>---</option>";

     createTask($uname);
     echo "</select><td><input class='content' name='hours[]' type='number'></td><td><input class='content' name='desc[]' type='text'></td></tr> ";
     
     }
}

echo "</form></table>";
?>
<script type="text/javascript">

    function dateselect(name){
    var start=document.getElementById("from").value;
    var end=document.getElementById("to").value;
    window.location.href="timesheetenter.php?start="+start+"&end="+end+"&pname="+name; //sending dates and name while submitting

    }
</script>
</center>
</body>
</html>