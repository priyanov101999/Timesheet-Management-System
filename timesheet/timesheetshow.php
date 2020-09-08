<!DOCTYPE html>
<!-- shows users induvidul time sheets connects to timesheetenter.php when user wants to make anew entry-->
<html>
<head>
	<title>Timesheet</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="basic.css">
	 <style type="text/css">
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
          border: none;
          background-color: #f7f7f7;
        }
     td{
      text-align: center;
     }
    </style>
</head>
<body bgcolor="#f7f7f7">
	
<?php

isset($_GET["pname"])?$name=$_GET["pname"]:$name="No Name"; //collecting username from previous page through link or form feild
echo "<div id=\"header\"><button ><i class=\"fas fa-user-circle\" style='color: #7CCF17'></i></button>Employee: <input type='text' id='uname' class='heading' value='".$name."' readonly>";
$today=date("Y-m-d");
$after7=date('Y-m-d',strtotime('-7 days'));   // pre entering the textboxes with dates from today to past 7 days
isset($_GET["start"])?$start=$_GET["start"]:$start=$after7;
isset($_GET["end"])?$end=$_GET["end"]:$end=$today;

echo "<button ><i class=\"far fa-calendar-alt\"></i></button>From:<input type='date' class='".$name."' id='from' value='".$start."' onchange=\"dateselect(this.className)\"> <button ><i class=\"far fa-calendar-alt\"></i></button>To:<input type='date'  value='".$end."' class='".$name."' id='to' onchange=\"dateselect(this.className)\">";
echo "<a href=\"timesheetenter.php?pname=$name\"><i class=\"far fa-calendar-plus\"></i></button></a>"; //button for new timesheet entry

echo "<a href=\"login.php\" style='float : right;'><i class=\"fas fa-power-off\"></i></a>";
echo "</div><br><br>";
///HEADER TILL HERE

echo '<form action="timesheetedit.php?pname='.$name.'" method="POST"><center><table width=80% border=1px><tr bgcolor=" #d9b3ff"><th>DATE</th><th>PROJECT</th><th>TASK</th><th>HOUR</th><th>DESCRIPTION</th><th class="edit" bgcolor="white">  </th></tr>';


//displaying the details
$conn = new mysqli("localhost","root","","timesheet");
if ($conn->connect_error) {
    die("Server Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM $name WHERE Date BETWEEN '$start' AND '$end'";

$result = $conn->query($sql);
$i=1;
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
      //displays client list table using select and adds edit,delete button
        echo "<tr><td class=\"".$i."\">".$row["Date"]."</td><td class=\"".$i."\">".$row["project"]."</td><td class=\"".$i."\">".$row["task"]."</td><td class=\"".$i."\">".$row["hour"]."</td><td class=\"".$i."\">".$row["description"]."</td><td class=\"".$i."\" >"."<button type=\"button\" class=\"".$i."\" onClick=\"edit_click(this.className)\"><i class=\"fas fa-pen\"></i></button>"."</td></tr>";
       $i++;//class names give the row number to determine which edit was clicked
    }
     

} else {
    echo "O results";
}
echo "</table></form>";
$conn->close();
?>
</center>
<script type="text/javascript">
	
function edit_click(bid) //on clicking edit button
{
     var y;
    var x=document.getElementsByClassName(bid);
    y=x[0].innerHTML;
    x[0].innerHTML='<input type="date" name="Date" style="width:200px; height:10px;" id="fix" readonly>';
    document.getElementById("fix").defaultValue = y;
    y=x[1].innerHTML;
    x[1].innerHTML='<input type="text" name="project" id="project" style="width:200px; height:10px;" readonly>';
    document.getElementById("project").defaultValue = y;
    y=x[2].innerHTML;
    x[2].innerHTML='<input type="text" name="task" id="task" style="width:200px; height:10px;" readonly>';
    document.getElementById("task").defaultValue = y;
    y=x[3].innerHTML;
    x[3].innerHTML='<input type="number" name="hour" id="hour" style="width:200px; height:10px;">';
    document.getElementById("hour").defaultValue = y;
    y=x[4].innerHTML;
    x[4].innerHTML='<input type="text" name="description" id="description" style="width:200px; height:10px;">';
     document.getElementById("description").defaultValue = y;
    x[5].innerHTML='<input type="submit" value="submit" style="width:50px; height:20px;">';


}
 function dateselect(name){
    var start=document.getElementById("from").value;
    var end=document.getElementById("to").value;
    window.location.href="timesheetshow.php?start="+start+"&end="+end+"&pname="+name;

    }
</script>

</body>
</html>